<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Campaign;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $query = Goal::with('campaign');
        if (request()->filled('search')) {
            $query->where(function ($q) {
                $searchTerm = request('search');
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('campaign', function ($c) use ($searchTerm) {
                        $c->where('title', 'like', '%' . $searchTerm . '%');
                    });
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
                $query->where('status', 'completed');
            } elseif (request('status') == 0) {
                $query->where('status', '!=', 'completed');
            }
        }

        $goals = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.goals.index', compact('goals'));
    }


    public function create()
    {
        $campaigns = Campaign::all();
        return view('admin.goals.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'target_amount' => 'required|numeric'
        ]);

        Goal::create($request->all());

        return redirect()->route('admin.goals.index')
            ->with('success', 'Goal created successfully');
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        $campaigns = Campaign::all();
        return view('admin.goals.edit', compact('goal', 'campaigns'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::findOrFail($id);
        $goal->update($request->all());

        return redirect()->route('admin.goals.index')
            ->with('success', 'Goal updated successfully');
    }

    public function destroy($id)
    {
        Goal::findOrFail($id)->delete();
        return back()->with('success', 'Goal deleted');
    }
}
