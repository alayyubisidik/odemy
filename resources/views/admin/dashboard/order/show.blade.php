<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->invoice_id }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            padding: 40px 20px;
            color: #1f2937;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
        }

        .btn-print {
            border: none;
            background: #206bc4;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-back {
            border: none;
            background: orange;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            margin-right: 20px;
        }

        .btn-print:hover {
            opacity: .9;
        }

        .invoice-card {
            background: white;
            border-radius: 14px;
            padding: 40px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, .05);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }

        .invoice-header h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .invoice-header p {
            color: #6b7280;
            line-height: 1.8;
            font-size: 14px;
        }

        .invoice-title {
            margin-bottom: 35px;
        }

        .invoice-title h1 {
            font-size: 34px;
            margin-bottom: 10px;
        }

        .invoice-title span {
            color: #6b7280;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #f9fafb;
        }

        table th {
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        table td {
            padding: 18px 14px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .product-title {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .product-instructor {
            color: #6b7280;
            font-size: 13px;
        }

        .summary-row td {
            border-bottom: none;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .summary-label {
            font-weight: 700;
        }

        .paid {
            color: #16a34a;
            font-weight: 700;
        }

        .footer-text {
            margin-top: 50px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.8;
        }

        @media print {

            body {
                background: white;
                padding: 0;
            }

            .btn-print {
                display: none;
            }

            .invoice-card {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
            }

            .topbar {
                display: none;
            }
        }


    </style>
</head>

<body>

    <div class="container">

        <div class="topbar">

            <div class="title">
                Invoice
            </div>

            <div class="topbar-actions">

                <a href="{{ url()->previous() }}" class="btn-back">
                    ← Back
                </a>

                <button class="btn-print" onclick="window.print()">
                    Print Invoice
                </button>

            </div>

        </div>
        <div class="invoice-card">

            <div class="invoice-header">

                <div>
                    <h3>Company</h3>

                    <p>
                        {{ config('settings.site_location') ?? 'Jl Jendral Sudirman, Jakarta' }}
                         <br>
                        {{ config('settings.site_email') ?? 'odemy@gmail.com'}}
                    </p>
                </div>

                <div class="text-end">
                    <h3>Client</h3>

                    <p>
                        {{ $order->customer->name }} <br><br>
                        {{ $order->customer->email }}
                    </p>
                </div>

            </div>

            <div class="invoice-title">
                <h1>Invoice #{{ $order->invoice_id }}</h1>

                <span>
                    Generated at {{ now()->format('d M Y H:i') }}
                </span>
            </div>

            <table>

                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Product</th>
                        <th width="10%" class="text-center">Qty</th>
                        <th width="20%" class="text-end">Amount</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($order->orderItems as $item)
                        <tr>

                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="product-title">
                                    {{ $item->product->title }}
                                </div>

                                <div class="product-instructor">
                                    By {{ $item->product->instructor->name }}
                                </div>
                            </td>

                            <td class="text-center">
                                1
                            </td>

                            <td class="text-end">
                                {{ rupiah($item->price) }}
                            </td>

                        </tr>
                    @endforeach

                    <tr class="summary-row">
                        <td colspan="3" class="text-end summary-label">
                            Subtotal
                        </td>

                        <td class="text-end">
                            {{ rupiah($order->total_amount) }}
                        </td>
                    </tr>

                    <tr class="summary-row">
                        <td colspan="3" class="text-end summary-label">
                            Paid Amount
                        </td>

                        <td class="text-end paid">
                            {{ rupiah($order->paid_amount) }}
                        </td>
                    </tr>

                </tbody>

            </table>

            <div class="footer-text">
                Thank you very much for doing business with us. <br>
                We look forward to working with you again!
            </div>

        </div>

    </div>

</body>

</html>
