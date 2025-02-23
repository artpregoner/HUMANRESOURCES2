<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Claim Details</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #fff;
        }

        .container {
            padding: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .invoice-number {
            text-align: right;
        }

        .invoice-number h2 {
            margin: 0;
            font-size: 24px;
            color: #000;
        }

        .invoice-number div {
            font-size: 14px;
            color: #666;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-submitted {
            background-color: #e9f7ff;
            color: #0369a1;
        }

        .badge-unrejected {
            background-color: #fff3cd;
            color: #856404;
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .user-details {
            flex-grow: 1;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #000;
        }

        .user-email {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
        }

        .submitted-by {
            text-align: right;
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #000;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            font-size: 14px;
            color: #333;
        }

        .input-form {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            font-size: 14px;
            color: #333;
        }

        .dates-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .date-group {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #000;
        }

        .amount-column {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .checkbox-group {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input {
            margin: 0;
        }

        .checkbox-group label {
            font-size: 14px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <span class="badge {{ $statusBadge }}">
                    {{ ucfirst($claim->status) }}
                </span>
                <span style="font-size: 14px; color: #666; margin-left: 10px;">{{ $actionedBy }}</span>
            </div>
            <div class="invoice-number">
                <h2>Expense Claim</h2>
                <div>Claims #{{ $claim->id }}</div>
            </div>
        </div>

        <div class="user-info">
            <div class="user-details">
                <h3 class="user-name">{{ $claim->user->name }}</h3>
                <div class="user-email">{{ $claim->user->email }}</div>
                @if($claim->assigned_to_id)
                    <h3 class="user-name">Assigned to: {{ $claim->assignedTo->name }}</h3>
                @endif
            </div>
            <div class="submitted-by">
                Submitted by: {{ $claim->submittedBy->name }}
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Currency</label>
            <div class="input-form">{{ $claim->currency }}</div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <div class="form-control">{{ $claim->description }}</div>
        </div>

        <div class="form-group">
            <label class="form-label">Comments</label>
            <div class="form-control" style="min-height: 100px;">{{ $claim->comments }}</div>
        </div>

        <div class="dates-container">
            <div class="date-group">
                <label class="form-label">Expense Date</label>
                <div class="input-form">{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}</div>
            </div>
            <div class="date-group">
                <label class="form-label">Submitted Date</label>
                <div class="input-form">{{ Carbon\Carbon::parse($claim->submitted_date)->format('M d, Y - h:i A') }}</div>
            </div>
            <div class="date-group">
                <label class="form-label">Approved Date</label>
                <div class="input-form">{{ $claim->approved_date ? Carbon\Carbon::parse($claim->approved_date)->format('M d, Y') : 'N/A' }}</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Details</th>
                    <th class="amount-column">Amount ({{ $claim->currency }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($claim->items as $item)
                    <tr>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->details }}</td>
                        <td class="amount-column">{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <th colspan="2" class="amount-column">Total:</th>
                    <th class="amount-column">{{ number_format($claim->total_amount, 2) }}</th>
                </tr>
            </tbody>
        </table>

        @if($claim->reimbursement_required)
            <div class="checkbox-group">
                <input type="checkbox" class="custom-control-input" name="reimbursement_required" checked disabled>
                <label>Reimbursement is required for this expense claim</label>
            </div>
        @endif
        <div class="submitted-by">
            Signature___________
        </div>
    </div>
</body>
</html>
