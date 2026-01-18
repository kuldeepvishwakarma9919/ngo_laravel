<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationTransaction;
use Illuminate\Http\Request;
use Exception;
use App\Models\Campaign;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationController extends Controller
{

    private $razorpayId = "rzp_test_RxsuJmb5HqR6ze";
    private $razorpayKey = "pvHZP0guu2uwhYuBWHZTuZJd";

    public function createOrder(Request $request)
    {
        $amount = $request->amount * 100;
        $data = [
            'receipt'  => 'rcpt_' . time(),
            'amount'   => $amount,
            'currency' => 'INR',
        ];
        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->razorpayId . ":" . $this->razorpayKey);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        $order = json_decode($response);
        curl_close($ch);

        return response()->json([
            'order_id' => $order->id,
            'amount'   => $amount
        ]);
    }

    public function store(Request $request)
    {

        $transaction = DonationTransaction::create([
            'donor_name'      => $request->donor_name,
            'donor_email'     => $request->donor_email,
            'donor_phone'     => $request->donor_phone,
            'amount'          => $request->amount,
            'payment_id'      => $request->razorpay_payment_id,
            'payment_gateway' => 'Razorpay',
            'payment_status'  => 'success',
            'receipt_no'      => 'RCT' . now()->format('Ymd') . rand(1000, 9999),
        ]);
        Donation::create([
            'user_id' => 1,
            'amount' => $request->amount,
            'payment_mode' => 'online',
            'transaction_id' => $request->razorpay_payment_id,
            'status' => 'approved',
            'donation_date' => now()
        ]);

        return response()->json(['status' => 'success', 'message' => 'Data Saved']);
    }

    public function showDonateForm($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('donates', compact('campaign'));
    }

    public function saveTransaction(Request $request)
    {
        $receipt = 'REC-' . time() . rand(10, 99);

        $transaction = DonationTransaction::create([
            'donor_name'     => $request->donor_name,
            'donor_email'    => $request->donor_email,
            'donor_phone'    => $request->donor_phone,
            'campaign_id'    => $request->campaign_id,
            'amount'         => $request->amount,
            'payment_id'     => $request->payment_id,
            'payment_gateway' => 'razorpay',
            'payment_status' => 'success',
            'receipt_no'     => $receipt,
        ]);

        // 2. Campaign Table ka Amount Update karna
        $campaign = Campaign::find($request->campaign_id);
        $campaign->increment('raised_amount', $request->amount);

        return response()->json([
            'success' => true,
            'receipt_no' => $receipt
        ]);
    }



    public function downloadReceipt($receipt_no)
    {
        $transaction = DonationTransaction::with('campaign')->where('receipt_no', $receipt_no)->firstOrFail();
        $pdf = Pdf::loadView('receipts.pdf', compact('transaction'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('NGO_Receipt_' . $receipt_no . '.pdf');
    }
}
