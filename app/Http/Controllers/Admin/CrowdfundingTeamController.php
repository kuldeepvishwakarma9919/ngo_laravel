<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrowdfundingTeam;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

class CrowdfundingTeamController extends Controller
{

    public function index()
    {
        $query = CrowdfundingTeam::with(['campaign', 'leader']);
        if (request()->filled('search')) {
            $query->whereHas('campaign', function ($q) {
                $search = request('search');
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        if (request()->filled('from_date')) {
            $query->whereDate('created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('created_at', '<=', request('to_date'));
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        $teams = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.crowdfunding_teams.index', compact('teams'));
    }


    public function create()
    {
        $campaigns = Campaign::where('status', 'active')->get();
        $leaders   = User::all();

        return view('admin.crowdfunding_teams.create', compact('campaigns', 'leaders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id'   => 'required',
            'team_name'     => 'required|string|max:100',
            'leader_id'     => 'nullable',
            'target_amount' => 'required|numeric',
        ]);

        CrowdfundingTeam::create([
            'campaign_id'   => $request->campaign_id,
            'team_name'     => $request->team_name,
            'leader_id'     => $request->leader_id,
            'target_amount' => $request->target_amount,
            'raised_amount' => 0,
            'status'        => 'active'
        ]);

        return redirect()->route('admin.crowdfunding-teams.index')
            ->with('success', 'Team created successfully');
    }

    public function edit($id)
    {
        $team = CrowdfundingTeam::findOrFail($id);
        $campaigns = Campaign::all();
        $leaders = User::all();

        return view('admin.crowdfunding_teams.edit', compact('team', 'campaigns', 'leaders'));
    }

    public function update(Request $request, $id)
    {
        $team = CrowdfundingTeam::findOrFail($id);

        $team->update([
            'campaign_id'   => $request->campaign_id,
            'team_name'     => $request->team_name,
            'leader_id'     => $request->leader_id,
            'target_amount' => $request->target_amount,
            'status'        => $request->status
        ]);

        return redirect()->route('admin.crowdfunding-teams.index')
            ->with('success', 'Team updated successfully');
    }

    public function destroy($id)
    {
        CrowdfundingTeam::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Team deleted');
    }
}
