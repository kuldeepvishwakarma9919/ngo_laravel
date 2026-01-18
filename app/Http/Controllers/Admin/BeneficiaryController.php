<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{

    public function index() 
{
    $query = Beneficiary::query();
    if (request()->filled('search')) {
        $query->where(function ($q) {
            $search = request('search');
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->orWhere('support_type', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
        });
    }

    if (request()->filled('from_date')) {
        $query->whereDate('created_at', '>=', request('from_date'));
    }

    
    if (request()->filled('to_date')) {
        $query->whereDate('created_at', '<=', request('to_date'));
    }
    if (request()->filled('status')) {
        if (request('status') == 1) {
            $query->where('status', 'active');
        } elseif (request('status') == 0) {
            $query->where('status', 'closed');
        }
    }


    $beneficiaries = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.beneficiaries.index', compact('beneficiaries'));
}


    public function create()
    {
        return view('admin.beneficiaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable|digits_between:10,12',
        ]);

        Beneficiary::create($request->all());

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Beneficiary added successfully');
    }

    public function edit(Beneficiary $beneficiary)
    {
        return view('admin.beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $beneficiary->update($request->all());

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', 'Beneficiary updated');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return back()->with('success', 'Beneficiary deleted');
    }
}
