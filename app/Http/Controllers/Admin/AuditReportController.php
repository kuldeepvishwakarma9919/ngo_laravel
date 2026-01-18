<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditReport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AuditReportController extends Controller
{
   public function index()
{
    $query = AuditReport::query();

    if (request()->filled('search')) {
        $query->where(function ($q) {
            $search = request('search');
            $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('ca_name', 'like', '%' . $search . '%');
        });
    }
    if (request()->filled('from_date')) {
        $query->whereDate('created_at', '>=', request('from_date'));
    }
    if (request()->filled('to_date')) {
        $query->whereDate('created_at', '<=', request('to_date'));
    }

    if (request()->filled('status')) {
        $query->where('is_public', request('status'));
    }

    $reports = $query->latest()->paginate(10)->withQueryString();
    return view('admin.audit_reports.index', compact('reports'));
}

    public function create()
    {
        return view('admin.audit_reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'financial_year' => 'required',
            'report_type' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/audit_reports', 'public');

        AuditReport::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'financial_year' => $request->financial_year,
            'report_type' => $request->report_type,
            'file_path' => $path,
            'file_size' => round($file->getSize() / 1024, 2) . ' KB',
            'ca_name' => $request->ca_name,
            'udid_number' => $request->udid_number,
            'summary' => $request->summary,
            'is_public' => $request->is_public ?? 1,
        ]);

        return redirect()->route('admin.audit-reports.index')
            ->with('success', 'Audit Report Added Successfully');
    }

    public function show(AuditReport $audit_report)
    {
        return view('admin.audit_reports.show', compact('audit_report'));
    }

    public function edit(AuditReport $audit_report)
    {
        return view('admin.audit_reports.edit', compact('audit_report'));
    }

    public function update(Request $request, AuditReport $audit_report)
    {
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($audit_report->file_path);

            $file = $request->file('file');
            $audit_report->file_path = $file->store('uploads/audit_reports', 'public');
            $audit_report->file_size = round($file->getSize() / 1024, 2) . ' KB';
        }

        $audit_report->update($request->except('file'));

        return redirect()->route('admin.audit-reports.index')
            ->with('success', 'Audit Report Updated');
    }

    public function destroy(AuditReport $audit_report)
    {
        Storage::disk('public')->delete($audit_report->file_path);
        $audit_report->delete();

        return back()->with('success', 'Audit Report Deleted');
    }

    // Download
    public function download($id)
    {
        $report = AuditReport::findOrFail($id);
        $report->increment('download_count');

        return Storage::disk('public')->download($report->file_path);
    }
}
