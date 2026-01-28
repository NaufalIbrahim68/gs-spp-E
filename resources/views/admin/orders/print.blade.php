<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pesanan - {{ $order->invoice ?? 'INV/2024/001' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            font-size: 10pt;
        }

        @page {
            margin: 20mm;
            size: A4 portrait;
        }

        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #6772e5;
        }

        .invoice-header .company-details .company-name {
            font-family: 'Roboto', sans-serif;
            font-size: 24pt;
            font-weight: 700;
            color: #6772e5;
            margin-bottom: 5px;
        }

        .invoice-header .company-details p {
            font-size: 9pt;
            color: #555;
            line-height: 1.4;
        }

        .invoice-header .invoice-info h2 {
            font-family: 'Roboto', sans-serif;
            font-size: 18pt;
            color: #333;
            text-align: right;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .invoice-header .invoice-info p {
            font-size: 10pt;
            text-align: right;
            color: #444;
        }

        .customer-details-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 10pt;
        }
        .customer-details-section div {
            width: 48%;
        }
        .customer-details-section h5 {
            font-family: 'Roboto', sans-serif;
            font-size: 11pt;
            color: #6772e5;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 4px;
        }
        .customer-details-section p {
            margin-bottom: 3px;
            color: #555;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 9.5pt;
        }

        .items-table thead th {
            background-color: #6772e5;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-family: 'Roboto', sans-serif;
        }
        .items-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .items-table td.col-qty, .items-table th.col-qty { text-align: center; }
        .items-table td.col-price, .items-table th.col-price,
        .items-table td.col-subtotal, .items-table th.col-subtotal { text-align: right; }

        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }
        .totals-section table {
            width: 45%;
            font-size: 10pt;
        }
        .totals-section td {
            padding: 8px 10px;
        }
        .totals-section .label {
            text-align: right;
            font-weight: 600;
            color: #444;
        }
        .totals-section .value {
            text-align: right;
            color: #333;
        }
        .totals-section .grand-total .label,
        .totals-section .grand-total .value {
            font-weight: 700;
            font-size: 12pt;
            color: #6772e5;
            border-top: 2px solid #6772e5;
            padding-top: 10px;
        }

        .notes-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 9pt;
            color: #777;
        }
        .notes-footer h6 {
            font-family: 'Roboto', sans-serif;
            font-size: 10pt;
            color: #555;
            margin-bottom: 5px;
        }
        .notes-footer p {
            margin-bottom: 5px;
        }
        .thank-you {
            text-align: center;
            margin-top: 30px;
            font-size: 11pt;
            font-weight: 600;
            color: #6772e5;
        }

        @media print {
            body {
                background-color: #fff;
                padding: 0;
                font-size: 9pt;
            }
            .invoice-box {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
                max-width: 100%;
                border-radius: 0;
            }
            .invoice-header {
                padding-bottom: 15px;
                margin-bottom: 30px;
            }
            .invoice-header .company-details .company-name { font-size: 20pt; }
            .invoice-header .invoice-info h2 { font-size: 16pt; }

            .items-table th, .items-table td { padding: 8px; font-size: 8.5pt; }
            .items-table thead th {
                background-color: #6772e5 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
             .totals-section table { width: 50%; }
             .totals-section td { padding: 6px 8px; }
             .totals-section .grand-total .label,
             .totals-section .grand-total .value { font-size: 11pt; }

            .notes-footer { font-size: 8pt; margin-top: 30px;}
            .thank-you { font-size: 10pt; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <header class="invoice-header">
            <div class="company-details">
                <div class="company-name">Toko Emas Gombong-Safary</div>
                <p>Cilacap<br>
                Telp: 08892388239<br>
                Email: help@gold.com</p>
            </div>
            <div class="invoice-info">
                <h2>Invoice</h2>
                <p>No. Invoice: <strong>{{ $order->invoice ?? 'INV/2024/001' }}</strong></p>
                <p>Tanggal: {{ ($order->created_at ?? now())->format('d F Y') }}</p>
                <p>Status: <span style="font-weight: bold; color: {{ ($order->status ?? 0) == 0 ? 'red' : 'green' }};">{!! $order->status_label ?? 'LUNAS' !!}</span></p>
            </div>
        </header>

        <section class="customer-details-section">
            <div class="billed-to">
                <h5>Dikirim Kepada:</h5>
                <p><strong>{{ $order->customer_name ?? 'Pelanggan Umum' }}</strong></p>
                <p>{{ $order->customer_phone ?? 'N/A' }}</p>
                <p>{{ $order->customer_address ?? 'Alamat tidak tersedia' }}</p>
                @if(isset($order->district))
                <p>{{ $order->district->name ?? '' }}, {{ $order->district->city->type ?? '' }} {{ $order->district->city->name ?? '' }}</p>
                <p>{{ $order->district->city->province->name ?? '' }}</p>
                @endif
            </div>

        </section>

        <section class="items-table-section">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Deskripsi Produk</th>
                        <th class="col-qty">Qty</th>
                        <th class="col-price">Harga Satuan</th>
                        <th class="col-subtotal">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php $itemNumber = 0; @endphp
                    @foreach ($order->orderDetail ?? [] as $item)
                    @php $itemNumber++; @endphp
                    <tr>
                        <td class="text-center">{{ $itemNumber }}</td>
                        <td>
                            <strong>{{ $item->product->name ?? 'Nama Produk Contoh' }}</strong><br>
                            </td>
                        <td class="col-qty">{{ $item->qty ?? 1 }}</td>
                        <td class="col-price">Rp {{ number_format($item->price ?? 50000, 0, ',', '.') }}</td>
                        <td class="col-subtotal">Rp {{ number_format(($item->price ?? 50000) * ($item->qty ?? 1), 0, ',', '.') }}</td>
                    </tr>
                    @php $itemNumber = 2; @endphp
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="totals-section">
            <table>
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="value">Rp {{ number_format($order->subtotal ?? 175000, 0, ',', '.') }}</td>
                </tr>
                @if(isset($order->shipping_cost) && $order->shipping_cost > 0)
                <tr>
                    <td class="label">Ongkos Kirim:</td>
                    <td class="value">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if(isset($order->discount) && $order->discount > 0)
                <tr>
                    <td class="label">Diskon:</td>
                    <td class="value">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="grand-total">
                    <td class="label">Total Keseluruhan:</td>
                    <td class="value">Rp {{ number_format(($order->subtotal ?? 175000) + ($order->shipping_cost ?? 0) - ($order->discount ?? 0), 0, ',', '.') }}</td>
                </tr>
            </table>
        </section>

        @if(isset($order->payment))
        <section class="notes-footer payment-info">
            <h6>Informasi Pembayaran:</h6>
            <p>Metode Pembayaran: {{ $order->payment->transfer_to ?? 'N/A' }}</p>
            <p>Nama Pengirim: {{ $order->payment->name ?? 'N/A' }}</p>
            <p>Tanggal Transfer: {{ isset($order->payment->transfer_date) ? \Carbon\Carbon::parse($order->payment->transfer_date)->format('d F Y') : 'N/A' }}</p>
            <p>Status Pembayaran: {!! $order->payment->status_label ?? 'Belum Dikonfirmasi' !!}</p>
        </section>
        @endif

        <section class="notes-footer">
            <h6>Catatan:</h6>
            <p>
                {{ $order->notes ?? 'Tidak ada catatan tambahan untuk pesanan ini.' }}
            </p>
            <p>Harap simpan invoice ini sebagai bukti pembelian yang sah.</p>
        </section>

        <div class="thank-you">
            <p>Terima kasih telah berbelanja di Toko Emas Gombong-Safary!</p>
        </div>
    </div>
</body>
</html>
