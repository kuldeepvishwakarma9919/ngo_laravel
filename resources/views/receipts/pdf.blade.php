<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #2c3e50;
        }

        /* Main Wrapper for A4 look */
        .receipt-container {
            padding: 40px;
            position: relative;
            border: 15px solid #f8f9fa;
            min-height: 90vh;
        }

        /* Header Section */
        .header-table {
            width: 100%;
            border-bottom: 3px solid #1a5928;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .ngo-name {
            font-size: 32px;
            font-weight: 800;
            color: #1a5928;
            margin: 0;
            letter-spacing: 1px;
        }

        .ngo-tagline {
            font-size: 14px;
            color: #555;
            text-transform: uppercase;
            margin-top: 5px;
        }

        /* Receipt Badge */
        .receipt-badge {
            background: #1a5928;
            color: #fff;
            padding: 10px 25px;
            display: inline-block;
            font-weight: bold;
            border-radius: 50px;
            margin-bottom: 30px;
        }

        /* Content Grid */
        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .content-table td {
            padding: 12px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .label {
            color: #7f8c8d;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: bold;
            width: 30%;
        }

        .value {
            color: #2c3e50;
            font-size: 16px;
            font-weight: 600;
        }

        /* Amount Highlight */
        .amount-row {
            background-color: #f4fff6;
            border: 1px solid #d4edda;
            margin: 30px 0;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
        }

        .amount-label {
            font-size: 14px;
            color: #1a5928;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .amount-value {
            font-size: 36px;
            font-weight: 800;
            color: #1a5928;
        }

        /* Message */
        .thank-you-note {
            text-align: center;
            margin-top: 40px;
            font-style: italic;
            color: #34495e;
            font-size: 15px;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 80px;
            width: 100%;
        }

        .signature-wrap {
            float: right;
            text-align: center;
            width: 220px;
        }

        .sig-line {
            border-top: 2px solid #2c3e50;
            margin-top: 60px;
            padding-top: 8px;
            font-weight: bold;
            font-size: 14px;
            color: #1a5928;
        }

        /* Footer Info */
        .footer-info {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            font-size: 11px;
            color: #bdc3c7;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt-container">

        <table class="header-table">
            <tr>
                <td>
                    <h1 class="ngo-name">NGO MISSION</h1>
                    <div class="ngo-tagline">Eng College Lucknow</div>
                </td>
                <td align="right" style="font-size: 14px; color: #7f8c8d;">
                    <strong>Reg No:</strong> 12345/NGO/2026 <br>
                    <strong>Date:</strong> {{ $transaction->created_at->format('d M, Y') }}
                </td>
            </tr>
        </table>

        <center>
            <div class="receipt-badge">DONATION RECEIPT</div>
        </center>

        <table class="content-table">
            <tr>
                <td class="label">Receipt Number</td>
                <td class="value">#{{ $transaction->receipt_no }}</td>
            </tr>
            <tr>
                <td class="label">Received From</td>
                <td class="value">{{ $transaction->donor_name }}</td>
            </tr>
            <tr>
                <td class="label">Campaign Name</td>
                <td class="value">{{ $transaction->campaign->title }}</td>
            </tr>
            <tr>
                <td class="label">Payment Source</td>
                <td class="value">{{ strtoupper($transaction->payment_gateway) }} (ID: {{ $transaction->payment_id }})
                </td>
            </tr>
            <tr>
                <td class="label">Contact Info</td>
                <td class="value">{{ $transaction->donor_email }} | {{ $transaction->donor_phone }}</td>
            </tr>
        </table>

        <div class="amount-row d-flex align-items-center">
            <span class="amount-label">TOTAL DONATION RECEIVED</span>
            <span class="amount-value">₹ {{ number_format($transaction->amount, 2) }}</span>
        </div>

        <div class="thank-you-note">
            "Your kindness makes a real difference. Thank you for supporting our mission to create a better world for
            everyone."
        </div>

        <div class="signature-section">
            <div style="float: left; width: 60%; font-size: 12px; margin-top: 60px; color: #7f8c8d;">
                <p><strong>Note:</strong> Donations are exempt under 80G of IT Act.<br>
                    This is a digitally generated receipt.</p>
            </div>
            <div class="signature-wrap">
                <div class="sig-line">Authorized Signatory</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="footer-info">
            <table width="100%">
                <tr>
                    <td>www.ngomission.org</td>
                    <td align="center">support@ngomission.org</td>
                    <td align="right">+91 9517048512</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
