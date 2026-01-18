<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplianceDocument;
use Illuminate\Http\Request;

class ComplianceDocumentController extends Controller
{

    public function index()
    {
        $query = ComplianceDocument::query();
        if (request()->filled('search')) {
            $query->where(function ($q) {
                $search = request('search'); // Global helper use kiya
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('doc_type', 'like', '%' . $search . '%')
                    ->orWhere('doc_number', 'like', '%' . $search . '%');
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

        $docs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.compliance.index', compact('docs'));
    }


    public function create()
    {
        return view('admin.compliance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'doc_type' => 'required',
            'file' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        $path = $request->file('file')
            ->store('uploads/compliance', 'public');

        ComplianceDocument::create([
            'title' => $request->title,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'authority' => $request->authority,
            'file_path' => $path,
            'status' => $request->status,
            'is_public' => $request->is_public ?? 0,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.compliance.index')
            ->with('success', 'Compliance Document Added');
    }

    public function edit($id)
    {
        $doc = ComplianceDocument::findOrFail($id);
        return view('admin.compliance.edit', compact('doc'));
    }

    public function update(Request $request, $id)
    {
        $doc = ComplianceDocument::findOrFail($id);

        if ($request->hasFile('file')) {
            $path = $request->file('file')
                ->store('uploads/compliance', 'public');
            $doc->file_path = $path;
        }

        $doc->update($request->except('file'));

        return redirect()->route('admin.compliance.index')
            ->with('success', 'Document Updated');
    }

    public function destroy($id)
    {
        ComplianceDocument::findOrFail($id)->delete();
        return back()->with('success', 'Document Deleted');
    }
}
