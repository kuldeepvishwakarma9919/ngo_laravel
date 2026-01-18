<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\IdCardVerification;
use App\Models\Role;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Generator;
use App\Models\User;

use PDF;

class Admin_members extends Controller
{
    public function generateQr($id)
    {
        $member = Member::findOrFail($id);

        if (!$member->qr_token) {
            $member->qr_token = Str::random(40);
        }

        $qrPath = 'uploads/qr/member_' . $member->id . '.png';

        $qr = new Generator('gd');
        dd($qr);
        $qr->format('png')
            ->size(300)
            ->generate(url('/verify-id-card/' . $member->qr_token), public_path($qrPath));

        $member->qr_code = $qrPath;
        $member->save();

        return redirect()->back()->with('success', 'QR Code generated successfully');
    }


    public function index()
    {
        $members = Member::with('user')
            ->when(request('name'), function ($query, $name) {
                $query->where('father_name', 'like', "%{$name}%");
            })
            ->when(request('city'), function ($query, $city) {
                $query->where('city', $city);
            })
            ->when(request('blade_group'), function ($query, $group) {
                $query->where('blade_group', $group);
            })
            ->when(request('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        $roles = Role::where('status', 1)->get();

        return view('admin.members.index', compact('members', 'roles'));
    }


    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'blade_group' => 'required|string',
            'aadhaar_no' => 'required|string|unique:members,aadhaar_no',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'occupation' => 'required|string',
            'qualification' => 'required|string',
            'id_card_no' => 'required|string|unique:members,id_card_no',
            'joined_date' => 'required|date',
            'status' => 'required|in:0,1',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/members'), $photoName);
        }

        Member::create([
            'user_id' => auth()->id(),
            'father_name' => $request->father_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'blade_group' => $request->blade_group,
            'aadhaar_no' => $request->aadhaar_no,
            'photo' => $photoName,
            'occupation' => $request->occupation,
            'qualification' => $request->qualification,
            'id_card_no' => $request->id_card_no,
            'joined_date' => $request->joined_date,
            'status' => $request->status,
        ]);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'father_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'blade_group' => 'required|string',
            'aadhaar_no' => "required|string|unique:members,aadhaar_no,{$id}",
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'occupation' => 'required|string',
            'qualification' => 'required|string',
            'id_card_no' => "required|string|unique:members,id_card_no,{$id}",
            'joined_date' => 'required|date',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/members'), $photoName);
            if ($member->photo && file_exists(public_path($member->photo))) {
                unlink(public_path($member->photo));
            }
            $member->photo = $photoName;
        }

        $member->update($request->except('photo'));

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function toggleStatus($id)
    {
        $member = Member::findOrFail($id);
        $member->status = $member->status == 1 ? 0 : 1;
        $member->save();
        return redirect()->back()->with('success', 'Member status updated.');
    }
    public function exportCsv()
    {
        $members = Member::all();
        $csvHeader = [
            'ID',
            'Father Name',
            'DOB',
            'Gender',
            'Address',
            'City',
            'State',
            'Pincode',
            'Blade Group',
            'Aadhaar No',
            'Occupation',
            'Qualification',
            'ID Card No',
            'Joined Date',
            'Status'
        ];

        $callback = function () use ($members, $csvHeader) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);

            foreach ($members as $m) {
                fputcsv($file, [
                    $m->id,
                    $m->father_name,
                    $m->dob,
                    $m->gender,
                    $m->address,
                    $m->city,
                    $m->state,
                    $m->pincode,
                    $m->blade_group,
                    $m->aadhaar_no,
                    $m->occupation,
                    $m->qualification,
                    $m->id_card_no,
                    Carbon::parse($m->joined_date)->format('d-m-Y'),
                    $m->status == 1 ? 'Active' : 'Inactive'
                ]);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=members.csv"
        ]);
    }
    public function exportPdf()
    {
        $members = Member::all();
        $pdf = PDF::loadView('admin.members.pdf', compact('members'));
        return $pdf->download('members.pdf');
    }
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $userId = $member->user_id;
        $member->delete();
        User::where('id', $userId)->delete();
        return redirect()->back()->with('success', 'Member aur User dono delete ho gaye');
    }
}
