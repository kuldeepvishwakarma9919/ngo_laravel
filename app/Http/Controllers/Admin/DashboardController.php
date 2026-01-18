<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Event;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\DonationTransaction; 

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = User::where('role', 'member')->count();
        $totalGallery = Gallery::count();
        $totalEvents = Event::count();
        $totalDonations = DonationTransaction::sum('amount');
    

        $monthlyData = DonationTransaction::selectRaw('SUM(amount) as total, MONTHNAME(created_at) as month')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('created_at')
            ->get();


        $chartLabels = $monthlyData->pluck('month')->toArray();
        $chartValues = $monthlyData->pluck('total')->toArray();
        $expenseData = Expense::selectRaw('SUM(amount) as total, category')
            ->groupBy('category')
            ->get();

        $expenseLabels = $expenseData->pluck('category')->toArray();
        $expenseValues = $expenseData->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalGallery',
            'totalEvents',
            'totalDonations',
            'chartLabels',
            'chartValues',
            'expenseLabels',
            'expenseValues'
        ));
    }
}
