<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
   public function index() 
{
    $query = Volunteer::query();

    if (request()->filled('search')) {
        $query->where(function ($q) {
            $search = request('search'); 
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('skills', 'like', '%' . $search . '%');
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

    $volunteers = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.volunteers.index', compact('volunteers'));
}

    public function create()
    {
        return view('admin.volunteers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable|digits_between:10,12',
        ]);

        Volunteer::create($request->all());

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer added successfully');
    }

    public function edit(Volunteer $volunteer)
    {
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $volunteer->update($request->all());

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer updated successfully');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return back()->with('success', 'Volunteer deleted');
    }
}
