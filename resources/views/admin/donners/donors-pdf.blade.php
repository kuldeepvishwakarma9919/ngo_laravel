<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donors Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Donors Report</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Donor Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Amount (₹)</th>
            <th>Gateway</th>
            <th>Status</th>
            <th>Receipt No</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donors as $index => $donor)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $donor->donor_name }}</td>
                <td>{{ $donor->donor_email }}</td>
                <td>{{ $donor->donor_phone }}</td>
                <td>{{ number_format($donor->amount, 2) }}</td>
                <td>{{ $donor->payment_gateway }}</td>
                <td>{{ ucfirst($donor->payment_status) }}</td>
                <td>{{ $donor->receipt_no ?? '-' }}</td>
                <td>{{ $donor->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
