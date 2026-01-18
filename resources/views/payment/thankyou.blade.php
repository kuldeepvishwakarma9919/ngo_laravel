@extends('home.masters.layouts.app')

@section('title', 'Payment Receipt')

@section('content')

{{-- <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet"> --}}

<style>
    :root {
        --primary-purple: #008000;
        --light-purple: #f3ebff;
        --bg-grid: #f9f7ff;
    }

    body { 
        /* font-family: 'Plus Jakarta Sans', sans-serif;  */
        background-color: #f0f2f5; 
    }

    /* Print Setup: Sirf Receipt print karne ke liye */
    @media print {
        @page { 
            size: A4; 
            margin: 0; /* Yeh browser ke default header/footer ko remove karta hai */
        }
        
        /* Baaki sab hide karne ke liye */
        html, body {
            height: 100%;
            margin: 0 !important; 
            padding: 0 !important;
            overflow: hidden;
            background: #fff !important;
        }

        nav, footer, .no-print, .navbar, .btn, header { 
            display: none !important; 
        }

        .receipt-container { 
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            height: 100vh;
        }

        .main-card { 
            border: none !important; 
            border-radius: 0 !important; 
            box-shadow: none !important;
            height: 100vh;
            width: 100% !important;
            background-color: var(--bg-grid) !important;
            -webkit-print-color-adjust: exact; /* Colors print karne ke liye */
        }
    }

    /* UI Design */
    .receipt-container {
        max-width: 800px;
        margin: 40px auto;
    }

    .main-card {
        background: var(--bg-grid);
        background-image: radial-gradient(#d1c4e9 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        border-radius: 20px;
        border: 2px solid var(--primary-purple);
        overflow: hidden;
        position: relative;
        min-height: 1000px; /* A4 height alignment */
    }

    .header-section { padding: 50px 50px 20px 50px; }
    
    .invoice-title {
        font-size: 50px;
        font-weight: 800;
        color: var(--primary-purple);
        letter-spacing: 2px;
    }

    .info-line {
        border-bottom: 1px solid var(--primary-purple);
        display: inline-block;
        min-width: 180px;
        margin-left: 8px;
        color: #333;
        font-weight: 600;
    }

    .items-container {
        margin: 20px 50px;
        border: 2px solid var(--primary-purple);
        border-radius: 20px;
        background: white;
        overflow: hidden;
    }

    .table-header {
        background: var(--primary-purple);
        color: white;
        padding: 15px 25px;
        font-weight: 600;
    }

    .item-row {
        padding: 20px 25px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
    }

    .total-box {
        background: var(--primary-purple);
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        display: inline-block;
        font-weight: 800;
        font-size: 20px;
        margin-top: 15px;
    }

    .signature-line {
        border-top: 2px solid var(--primary-purple);
        width: 200px;
        margin-top: 60px;
    }
</style>

<div class="receipt-container">
    <div class="main-card shadow-lg" id="receipt">
        
        <div class="header-section">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="fw-bold mb-0" style="color: var(--primary-purple)">NGO LOGO</h4>
                    <p class="text-muted small">Official Donation Receipt</p>
                </div>
                <h1 class="invoice-title">INVOICE</h1>
            </div>

            <div class="mt-5 row">
                <div class="col-12 mb-3">
                    <span class="text-muted">Invoice to:</span> <span class="info-line">NGO-{{ $payment->id }}</span>
                </div>
                <div class="col-12 mb-3">
                    <span class="text-muted">Client name:</span> <span class="info-line">{{ $payment->member->user->name }}</span>
                </div>
                <div class="col-12">
                    <span class="text-muted">Date:</span> <span class="info-line">{{ date('d/m/Y', strtotime($payment->payment_date)) }}</span>
                </div>
            </div>
        </div>

        <div class="items-container">
            <div class="table-header d-flex justify-content-between">
                <span>ITEM DESCRIPTION</span>
                <div class="d-flex gap-5">
                    <span style="width: 50px; text-align: center;">QTY</span>
                    <span style="width: 100px; text-align: right;">TOTAL</span>
                </div>
            </div>
            
            <div class="item-row">
                <span>{{ ucfirst($payment->payment_type) }} Membership Fees</span>
                <div class="d-flex gap-5">
                    <span style="width: 50px; text-align: center;">1</span>
                    <span style="width: 100px; text-align: right; font-weight: bold;">₹{{ number_format($payment->amount, 2) }}</span>
                </div>
            </div>
            <div class="item-row" style="height: 60px;"></div>
            <div class="item-row" style="height: 60px; border-bottom: none;"></div>
        </div>

        <div class="px-5 pb-5 row mt-4">
            <div class="col-6">
                <h6 class="fw-bold" style="color: var(--primary-purple)">TERMS AND CONDITIONS</h6>
                <p class="small text-muted" style="font-size: 11px; line-height: 1.4;">
                    Thank you for your generous contribution. This receipt is valid as per NGO regulations. Donations are non-refundable.
                </p>
            </div>
            <div class="col-6 text-end">
                <p class="mb-1">Subtotal: <strong>₹{{ number_format($payment->amount, 2) }}</strong></p>
                <div class="total-box">
                    Total: ₹{{ number_format($payment->amount, 2) }}
                </div>

                <div class="d-flex flex-column align-items-end">
                    <div class="signature-line"></div>
                    <p class="fw-bold mt-2 mb-0" style="color: var(--primary-purple)">NGO DIRECTOR</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center no-print">
        <button onclick="window.print()" class="btn btn-lg px-5 text-white fw-bold shadow-sm" style="background: var(--primary-purple); border-radius: 50px;">
         Print Receipt
        </button>
    </div>
</div>

@endsection