<!DOCTYPE html>
<html>
<head>
    <title>Members Report</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 5px; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2>Members Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Father Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>City</th>
                <th>Blade Group</th>
                <th>Occupation</th>
                <th>ID Card No</th>
                <th>Joined Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $key => $m)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $m->father_name }}</td>
                <td>{{ \Carbon\Carbon::parse($m->dob)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($m->gender) }}</td>
                <td>{{ $m->city }}</td>
                <td>{{ $m->blade_group }}</td>
                <td>{{ $m->occupation }}</td>
                <td>{{ $m->id_card_no }}</td>
                <td>{{ \Carbon\Carbon::parse($m->joined_date)->format('d-m-Y') }}</td>
                <td>{{ $m->status == 1 ? 'Active' : 'Inactive' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
