<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationTransaction;
use App\Models\Donation;
use App\Models\TaxCertificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class DonarController extends Controller
{

    public function index()
    {
        $query = DonationTransaction::query();
        if (request()->filled('search')) {
            $query->where(function ($q) {
                $search = request('search');
                $q->where('donor_name', 'like', '%' . $search . '%')
                    ->orWhere('donor_email', 'like', '%' . $search . '%');
            });
        }

        if (request()->filled('from_date')) {
            $query->whereDate('created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('created_at', '<=', request('to_date'));
        }

        if (request()->filled('status')) {
            $query->where('payment_status', request('status'));
        }

        $donors = $query
            ->orderBy('created_at', 'desc')
            ->paginate(3)
            ->withQueryString();

        return view('admin.donners.index', compact('donors'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function exportCsv()
    {
        $fileName = 'donors_' . date('Y-m-d') . '.csv';

        $donors = DonationTransaction::orderBy('created_at', 'desc')->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($donors) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Donor Name',
                'Email',
                'Phone',
                'Amount',
                'Payment Gateway',
                'Status',
                'Receipt No',
                'Date'
            ]);

            foreach ($donors as $donor) {
                fputcsv($file, [
                    $donor->donor_name,
                    $donor->donor_email,
                    $donor->donor_phone,
                    $donor->amount,
                    $donor->payment_gateway,
                    $donor->payment_status,
                    $donor->receipt_no ?? '-',
                    $donor->created_at->format('Y-m-d'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function exportPdf()
    {
        $donors = DonationTransaction::orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.donners.donors-pdf', compact('donors'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('donors_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function donorList(Request $request)
    {
        $query = DonationTransaction::select(
            'donor_name',
            'donor_email',
            'donor_phone'
        )
            ->selectRaw('SUM(amount) as total_donation')
            ->selectRaw('COUNT(id) as total_transactions')
            ->selectRaw('MAX(id) as donation_id')
            ->groupBy('donor_name', 'donor_email', 'donor_phone');
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('donor_name', 'like', '%' . $request->search . '%')
                    ->orWhere('donor_email', 'like', '%' . $request->search . '%')
                    ->orWhere('donor_phone', 'like', '%' . $request->search . '%');
            });
        }

        $donors = $query
            ->orderByDesc('total_donation')
            ->paginate(2)
            ->withQueryString();

        return view('admin.donners.donnerlist', compact('donors'));
    }




    public function generate80G($donationId)
    {
        $donation = Donation::findOrFail($donationId);

        // Check already generated
        $certificate = TaxCertificate::where('donation_id', $donation->id)->first();
        if ($certificate) {
            return redirect()->back()->with('info', '80G Certificate already generated');
        }

        $certificateNo = '80G-' . date('Y') . '-' . Str::upper(Str::random(6));

        $pdf = Pdf::loadView('admin.certificates.80g', compact('donation', 'certificateNo'));

        $path = 'uploads/certificates/80g_' . $donation->id . '.pdf';
        $pdf->save(public_path($path));

        TaxCertificate::create([
            'donation_id'   => $donation->id,
            'certificate_no' => $certificateNo,
            'issued_date'   => now(),
            'financial_year' => date('Y') . '-' . (date('Y') + 1),
            'certificate_path' => $path
        ]);

        return redirect()->back()->with('success', '80G Certificate Generated');
    }
}
