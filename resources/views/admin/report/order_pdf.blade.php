<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
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

        .report-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
            border-radius: 8px;
        }

        .report-main-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #6772e5;
        }

        .report-main-header .company-details .company-name {
            font-family: 'Roboto', sans-serif;
            font-size: 24pt;
            font-weight: 700;
            color: #6772e5;
            margin-bottom: 5px;
        }

        .report-main-header .company-details p {
            font-size: 9pt;
            color: #555;
            line-height: 1.4;
        }

        .report-main-header .report-info h2 {
            font-family: 'Roboto', sans-serif;
            font-size: 18pt;
            color: #333;
            text-align: right;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .report-main-header .report-info p {
            font-size: 10pt;
            text-align: right;
            color: #444;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .orders-table th, .orders-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 9.5pt;
            vertical-align: middle;
        }

        .orders-table thead th {
            background-color: #6772e5;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }
        .orders-table thead th.text-left { text-align: left; }
        .orders-table thead th.text-right { text-align: right; }


        .orders-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
         .orders-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .orders-table td.text-center, .orders-table th.text-center { text-align: center; }
        .orders-table td.text-right, .orders-table th.text-right { text-align: right; }
        .orders-table td.text-left, .orders-table th.text-left { text-align: left; }


        footer.print-footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.3cm;
            font-size: 9pt;
            text-align: center;
            line-height: 1.2;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            background-color: #fff;
        }

        .custom-footer-page-number:after {
            content: "Halaman " counter(page);
        }

        .gambar-watermark {
            width: 450px;
            opacity: 0.08;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1000;
            display: none;
        }

        @media print {
            body {
                background-color: #fff;
                padding: 0;
                font-size: 9pt;
            }
            .report-container {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
                max-width: 100%;
                border-radius: 0;
            }
            .report-main-header {
                padding-bottom: 15px;
                margin-bottom: 20px;
            }
            .report-main-header .company-details .company-name { font-size: 20pt; }
            .report-main-header .report-info h2 { font-size: 16pt; }

            .orders-table th, .orders-table td { padding: 8px; font-size: 8.5pt; }
            .orders-table thead th {
                background-color: #6772e5 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .gambar-watermark {
                display: block;
            }
            footer.print-footer {
                display: block;
                font-size: 8pt;
            }
        }
    </style>
</head>
<body>
    <div class="report-container">
        <header class="report-main-header">
            <div class="company-details">
                <div class="company-name">Toko Emas Gombong-Safary</div> <p>Cilacap <br>
                   Email : help@gold.com</p>
            </div>
            <div class="report-info">
                <h2>Laporan Pesanan</h2>
                <p>Periode: {{ date('d F Y', strtotime($date[0] ?? now())) }} - {{ date('d F Y', strtotime($date[1] ?? now())) }}</p>
            </div>
        </header>

        <main>
            <div class="table-wrapper">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">Invoice</th>
                            <th class="text-left">Nama Pelanggan</th>
                            <th class="text-right">Subtotal</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order ?? [] as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $item->invoice }}</td>
                                <td class="text-left">{{ $item->customer_name }}</td>
                                <td class="text-right">Rp {{ number_format($item->subtotal) }}</td>
                                <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data pesanan untuk periode ini.</td>
                            </tr>
                        @endforelse
                         @if (!isset($order) || count($order ?? []) === 0)
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-left">INV/2024/001</td>
                                <td class="text-left">Pelanggan Contoh Satu</td>
                                <td class="text-right">Rp 150.000</td>
                                <td class="text-center">29-05-2024</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-left">INV/2024/002</td>
                                <td class="text-left">Pelanggan Contoh Dua</td>
                                <td class="text-right">Rp 275.000</td>
                                <td class="text-center">28-05-2024</td>
                            </tr>
                             <tr>
                                <td class="text-center">3</td>
                                <td class="text-left">INV/2024/003</td>
                                <td class="text-left">Budi Hartono</td>
                                <td class="text-right">Rp 500.000</td>
                                <td class="text-center">27-05-2024</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>

        <footer class="print-footer">
            <span class="custom-footer-page-number"></span>
        </footer>
    </div>
</body>
</html>
