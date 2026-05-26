<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ADC General Merchandise, INC.</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 5px;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .date {
            font-size: 11px;
            margin-top: 4px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #111827;
            color: white;
            padding: 8px;
            border: 1px solid #111827;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .total {
            font-weight: bold;
            background: #f3f6f1;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('img/logo.png') }}" class="logo">
    <h1 class="company-name">ADC General Merchandise, INC.</h1>
    <div class="date">Generated on {{ now()->format('F d, Y h:i A') }}</div>
</div>

<table>
    <thead>
        <tr>
            <th>Item Description</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Cost</th>
            <th>Total Value</th>
        </tr>
    </thead>

    <tbody>
        @php $grandTotal = 0; @endphp

        @foreach($items as $item)
            @php
                $total = $item->quantity * $item->cost;
                $grandTotal += $total;
            @endphp

            <tr>
                <td>{{ $item->item_description }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit }}</td>
                <td>PHP {{ number_format($item->cost, 2) }}</td>
                <td>PHP {{ number_format($total, 2) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="5" class="total">Grand Total</td>
            <td class="total">PHP {{ number_format($grandTotal, 2) }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>