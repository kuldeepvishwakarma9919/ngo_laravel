<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{

   public function index() 
{
    $query = Expense::query();
    if (request()->filled('search')) {
        $query->where(function ($q) {
            $search = request('search');
            $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->orWhere('paid_to', 'like', '%' . $search . '%');
        });
    }
    if (request()->filled('from_date')) {
        $query->whereDate('expense_date', '>=', request('from_date'));
    }
    if (request()->filled('to_date')) {
        $query->whereDate('expense_date', '<=', request('to_date'));
    }
    if (request()->filled('status')) {
        $query->where('status', request('status'));
    }
    $expenses = $query->latest()->paginate(10)->withQueryString();
    return view('admin.expenses.index', compact('expenses'));
}


    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
            'payment_mode' => 'required',
        ]);

        $path = null;
        if ($request->hasFile('bill')) {
            $path = $request->file('bill')->store('uploads/expenses', 'public');
        }

        Expense::create([
            'title' => $request->title,
            'category' => $request->category,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'payment_mode' => $request->payment_mode,
            'reference_no' => $request->reference_no,
            'paid_to' => $request->paid_to,
            'bill_path' => $path,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense Added Successfully');
    }

    public function edit(Expense $expense)
    {
        return view('admin.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($request->hasFile('bill')) {
            Storage::disk('public')->delete($expense->bill_path);
            $expense->bill_path = $request->file('bill')->store('uploads/expenses', 'public');
        }

        $expense->update($request->except('bill'));

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense Updated');
    }

    public function destroy(Expense $expense)
    {
        Storage::disk('public')->delete($expense->bill_path);
        $expense->delete();

        return back()->with('success', 'Expense Deleted');
    }
}
