<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Str;

class CampaignController extends Controller
{

    public function index()
    {
        $query = Campaign::query();

        if (request()->filled('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if (request()->filled('from_date')) {
            $query->whereDate('start_date', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('end_date', '<=', request('to_date'));
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        $campaigns = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10) 
            ->withQueryString();

        return view('admin.campaigns.index', compact('campaigns'));
    }


    public function create()
    {
        return view('admin.campaigns.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'target_amount' => 'required|numeric|min:1',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        Campaign::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'target_amount' => $request->target_amount,
            'raised_amount' => 0,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'status'        => $request->status ?? 1,
        ]);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign Created Successfully');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $campaign->update($request->all());

        return redirect()->back()->with('success', 'Campaign Updated');
    }
    public function close($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->status = 0;
        $campaign->save();

        return redirect()->back()->with('success', 'Campaign Closed');
    }
}
