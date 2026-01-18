<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Member;
use App\Models\MemberPayment;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'        => 'required|string|max:255',
    //         'email'       => 'required|email|unique:users,email',
    //         'dob'         => 'required|date',
    //         'gender'      => 'required',
    //         'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'adhaar_card' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         // ✅ OTHER ID CARD
    //         'select_id'   => 'nullable|string',
    //         'front'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'back'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
    //     ]);
    //     $photoPath = null;
    //     $aadhaarPath = null;

    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('members/photos', 'public');
    //     }

    //     if ($request->hasFile('adhaar_card')) {
    //         $aadhaarPath = $request->file('adhaar_card')->store('members/aadhaar', 'public');
    //     }
    //     $user = User::create([
    //         'name'     => $request->name,
    //         'email'    => $request->email,
    //         'password' => Hash::make('12345678'),
    //         'role'     => 'member',
    //         'status'   => 'active',
    //     ]);
    //     Member::create([
    //         'user_id'        => $user->id,
    //         'father_name'    => $request->father_name,
    //         'dob'            => $request->dob,
    //         'gender'         => $request->gender,
    //         'address'        => $request->address,
    //         'city'           => $request->city,
    //         'state'          => $request->state,
    //         'pincode'        => $request->pincode,
    //         'blade_group'    => $request->blade_group,
    //         'aadhaar_no'     => null,
    //         'photo'          => $photoPath,
    //         'occupation'    => $request->occupation,
    //         'qualification' => $request->educational,
    //         'state'         => $request->state,
    //         'city'          => $request->city,
    //         'pincode'       => $request->pincode,
    //         'mobile_no'     => $request->mobile_no,
    //         'aadhaar_no'   => $request->aadhaar_no,
    //         'id_card_no'     => 'NGO-' . time(),
    //         'joined_date'    => now(),
    //         'status'         => 1,
    //     ]);

    //     return redirect()->back()->with('success', 'Member registered successfully');
    // }



    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'dob'         => 'required|date',
            'gender'      => 'required',

            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'adhaar_card' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'select_id'   => 'nullable|string',
            'front'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'back'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);
        $photoPath = null;
        $aadhaarPath = null;
        $idCardFrontPath = null;
        $idCardBackPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members/photos', 'public');
        }

        if ($request->hasFile('adhaar_card')) {
            $aadhaarPath = $request->file('adhaar_card')->store('members/aadhaar', 'public');
        }

        if ($request->hasFile('front')) {
            $idCardFrontPath = $request->file('front')->store('members/id-cards/front', 'public');
        }

        if ($request->hasFile('back')) {
            $idCardBackPath = $request->file('back')->store('members/id-cards/back', 'public');
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('12345678'),
            'role'     => 'member',
            'status'   => 'inactive',
            'role_id'  => 5,
        ]);
        $member = Member::create([
            'user_id'        => $user->id,
            'father_name'    => $request->father_name,
            'dob'            => $request->dob,
            'gender'         => $request->gender,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'pincode'        => $request->pincode,
            'blade_group'    => $request->blade_group,
            'aadhaar_no'     => $request->aadhaar_no,
            'photo'          => $photoPath,
            'occupation'    => $request->occupation,
            'qualification' => $request->educational,
            'mobile_no'      => $request->mobile_no,
            'id_card_type'   => $request->select_id,
            'id_card_front'  => $idCardFrontPath,
            'id_card_back'   => $idCardBackPath,
            'id_card_no'     => 'NGO-' . time(),
            'joined_date'    => now(),
            'status'         => 0,
        ]);


        $payment = MemberPayment::create([
            'member_id' => $member->id,
            'membership_type' => $request->membership_type,
            'amount' => $request->amount,
            'payment_status' => 'pending',
        ]);
        

        // return redirect()->back()->with('success', 'Member registered successfully');
        return redirect()->route('payment.page', $payment->id);
    }


    public function paymentSuccess(Request $request)
    {
        $payment = MemberPayment::findOrFail($request->payment_db_id);

        $payment->update([
            'transaction_id' => $request->transaction_id,
            'payment_method' => 'razorpay',
            'payment_status' => 'success',
            'payment_date'   => now(),
        ]);
        $payment->member->update(['status' => 1]);
        $payment->member->user->update(['status' => 'active']);
        return redirect()->route('thankyou', $payment->id);
    }


    public function paymentPage($id)
    {
        $payment = MemberPayment::findOrFail($id);
        return view('payment.pay', compact('payment'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }



    public function getByIdCard(Request $request)
    {
        $request->validate([
            'id_card_no' => 'required|string',
        ]);

        // Member ko id_card_no se fetch karna
        $member = Member::where('id_card_no', $request->id_card_no)
            ->where('status', 1)
            ->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found. Please register first.'
            ]);
        }

        // User info bhi fetch karna
        $user = User::find($member->user_id);

        return response()->json([
            'success' => true,
            'member' => [
                'name'      => $user->name,
                'email'     => $user->email,
                'role'      => $user->role,
                'mobile'    => $user->member_id ?? '',  // agar member_id me phone store hai
                'photo'     => $member->photo,
                'id_card_no' => $member->id_card_no,
                'blood'     => $member->blood_group ?? 'N/A',
                'joined_date' => $member->joined_date,
            ]
        ]);
    }
}
