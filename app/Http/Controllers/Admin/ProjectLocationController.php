<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\ProjectLocation;
class ProjectLocationController extends Controller
{
   
public function index()
{
    $query = ProjectLocation::with('campaign');
    if (request()->filled('search')) {
        $query->where(function ($q) {
            $search = request('search'); 
            $q->where('project_name', 'like', '%' . $search . '%')
              ->orWhere('city', 'like', '%' . $search . '%')
              ->orWhere('state', 'like', '%' . $search . '%');
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

    $locations = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.project_locations.index', compact('locations'));
}



    public function create()
    {
        $campaigns = Campaign::all();
        return view('admin.project_locations.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required'
        ]);

        ProjectLocation::create($request->all());

        return redirect()->route('admin.project-locations.index')
            ->with('success', 'Project location added successfully');
    }

    public function edit($id)
    {
        $location = ProjectLocation::findOrFail($id);
        $campaigns = Campaign::all();

        return view('admin.project_locations.edit', compact('location','campaigns'));
    }

    public function update(Request $request, $id)
    {
        $location = ProjectLocation::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('admin.project-locations.index')
            ->with('success', 'Project location updated');
    }

    public function destroy($id)
    {
        ProjectLocation::findOrFail($id)->delete();
        return back()->with('success', 'Project location deleted');
    }
}
