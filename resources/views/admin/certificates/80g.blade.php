<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>80G Tax Donation Certificate</title>
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-blue: #0a2e4e;
            --brand-gold: #b8860b;
        }

        body {
            background-color: #f4f4f4;
            font-family: 'Roboto Condensed', sans-serif !important;
            padding: 30px;
        }

        /* Certificate Container */
        .certificate-container {
            width: 850px;
            margin: auto;
            background: #fff;
            padding: 15px;
            border: 2px solid var(--brand-blue);
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            position: relative;
        }

        .inner-border {
            border: 1px solid var(--brand-gold);
            padding: 40px;
            position: relative;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 70px;
            color: rgba(10, 46, 78, 0.03);
            font-weight: 900;
            white-space: nowrap;
            pointer-events: none;
            text-transform: uppercase;
            z-index: 0;
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid var(--brand-blue);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .ngo-name {
            font-family: 'Bodoni Moda', serif;
            font-size: 32px;
            font-weight: bold;
            color: var(--brand-blue);
            margin: 0;
            text-transform: uppercase;
        }

        .ngo-address {
            font-size: 13px;
            color: #555;
            margin-top: 5px;
        }

        /* Title */
        .certificate-title {
            text-align: center;
            font-family: 'Bodoni Moda', serif;
            font-size: 26px;
            font-weight: bold;
            color: var(--brand-gold);
            margin-bottom: 40px;
            font-style: italic;
        }

        /* Details Table */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .details-table td {
            padding: 12px 10px;
            font-size: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .label {
            font-weight: 700;
            width: 35%;
            color: #555;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .value {
            font-weight: 600;
            color: var(--brand-blue);
            width: 65%;
        }

        /* Declaration */
        .declaration {
            font-size: 14px;
            line-height: 1.7;
            text-align: center;
            margin: 40px 0;
            padding: 20px;
            background-color: #f9fbfd;
            border-radius: 5px;
            color: #444;
            border: 1px solid #eef2f6;
        }

        /* Footer Section */
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .reg-details {
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        .signatory-box {
            text-align: center;
            width: 220px;
        }

        .signature-line {
            border-top: 2px solid var(--brand-blue);
            padding-top: 8px;
            font-weight: bold;
            color: var(--brand-blue);
            font-size: 14px;
        }

        /* Print Optimization */
        @media print {
            body { background: none; padding: 0; }
            .certificate-container { box-shadow: none; border: 2px solid var(--brand-blue); }
        }
    </style>
</head>
<body>

<div class="certificate-container">
    <div class="inner-border">
        <div class="watermark">OFFICIAL RECEIPT</div>

        <div class="header">
            <p class="ngo-name">Aapki NGO Ka Naam</p>
            <p class="ngo-address">
                Plot No. 123, Sector 5, New Delhi - 110001<br>
                Registration No: BK-IV/1234/2024 | PAN: AAAAA1234A
            </p>
        </div>

        <div class="certificate-title">Donation Receipt & Appreciation</div>

        <table class="details-table">
            <tr>
                <td class="label">Certificate Number:</td>
                <td class="value">{{ $certificateNo }}</td>
            </tr>
            <tr>
                <td class="label">Donor Name:</td>
                <td class="value"><strong>{{ $donation->donor_name }}</strong></td>
            </tr>
            <tr>
                <td class="label">Donor PAN:</td>
                <td class="value">{{ $donation->donor_pan }}</td>
            </tr>
            <tr>
                <td class="label">Amount Contributed:</td>
                <td class="value" style="font-size: 20px; color: var(--brand-gold);">₹ {{ number_format($donation->amount, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Payment Mode:</td>
                <td class="value">{{ $donation->payment_mode }}</td>
            </tr>
            <tr>
                <td class="label">Date of Receipt:</td>
                <td class="value">{{ $donation->created_at->format('d-m-Y') }}</td>
            </tr>
        </table>

        <div class="declaration">
            Certified that this donation has been received for the welfare activities of the Organization. 
            This receipt is issued under <b>Section 80G of the Income Tax Act, 1961</b>. 
            The donor is entitled to claim a 50% deduction in respect of this contribution.
        </div>

        <div class="footer">
            <div class="reg-details">
                <b>NGO PAN:</b> AAAAA1234A<br>
                <b>80G Reg No:</b> AA/2024/80G/1234<br>
                <b>Validity:</b> Perennial (From AY 2024-25)
            </div>

            <div class="signatory-box">
                <div style="height: 50px;"></div> 
                <div class="signature-line">Authorized Signatory</div>
                <p style="font-size: 11px; color: #777; margin-top: 5px;">(Seal of the Organization)</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>