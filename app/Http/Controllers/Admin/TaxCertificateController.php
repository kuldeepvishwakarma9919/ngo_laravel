<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxCertificate;
class TaxCertificateController extends Controller
{
    public function index()
    {
        $certificates = TaxCertificate::with('donation')
            ->orderBy('issued_date', 'desc')
            ->get();

        return view('admin.tax_certificates.index', compact('certificates'));
    }
}
