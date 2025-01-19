<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAN Card Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f4f4f4;
            text-align: left;
        }
        .badge {
            padding: 5px 10px;
            color: #fff;
            border-radius: 4px;
            display: inline-block;
        }
        .bg-success {
            background-color: #28a745;
        }
        strong {
            font-weight: bold;
        }
        .null {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h2>PAN Card Details</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Field</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Unique ID:</strong></td>
                <td>{{ $panCard->unique_id }}</td>
            </tr>
            <tr>
                <td><strong>Application Mode:</strong></td>
                <td>{{ $panCard->application_mode }}</td>
            </tr>
            <tr>
                <td><strong>Application Type:</strong></td>
                <td>{{ $panCard->application_type }}</td>
            </tr>
            <tr>
                <td><strong>Acknowledgement Number:</strong></td>
                <td>{!! $panCard->acknowledgement_no ? $panCard->acknowledgement_no : "<span class='null'>null</span>" !!}</td>
            </tr>
            <tr>
                <td><strong>Category:</strong></td>
                <td>{{ $panCard->category }}</td>
            </tr>
            <tr>
                <td><strong>Branch Code:</strong></td>
                <td>{{ $panCard->branch_code }}</td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td>{{ $panCard->name }}</td>
            </tr>
            <tr>
                <td><strong>Gender:</strong></td>
                <td>{{ $panCard->gender }}</td>
            </tr>
            <tr>
                <td><strong>Mobile:</strong></td>
                <td>{{ $panCard->mobile }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ $panCard->email }}</td>
            </tr>
            <tr>
                <td><strong>PAN Type:</strong></td>
                <td>{{ $panCard->pan_type }}</td>
            </tr>
            <tr>
                <td><strong>Consent:</strong></td>
                <td>{{ $panCard->consent }}</td>
            </tr>
            <tr>
                <td><strong>Order ID:</strong></td>
                <td>{!! $panCard->order_id ? $panCard->order_id : "<span class='null'>null</span>" !!}</td>
            </tr>
            <tr>
                <td><strong>Authorization:</strong></td>
                <td>{!! $panCard->authorization ? "Generate" : "<span class='null'>null</span>" !!}</td>
            </tr>
            <tr>
                <td><strong>Message:</strong></td>
                <td>{!! $panCard->message ? $panCard->message : "<span class='null'>null</span>" !!}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td><span class="badge bg-success">{{ $panCard->status }}</span></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
