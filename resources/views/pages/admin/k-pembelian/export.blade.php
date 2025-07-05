<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pembelian</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
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
    <h2>Data Pembelian</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>Nominal</th>
                <th>Invoice</th>
                <th>No DO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
                @php
                    $user = \App\Models\User::find($d->user_id);
                    $produk = \App\Models\ProdukM::find($d->product_id);
                    $deliv = \App\Models\DeliveryOrderM::where('pembeli_id', $d->id)->first();
                    $inv = \App\Models\InvoiceM::where('pembeli_id', $d->id)->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->created_at }}</td>
                    <td>{{ $user ? $user->name : 'User not found' }}</td>
                    <td>{{ $produk ? $produk->name : 'Produk not found' }}</td>
                    <td>{{ $d->status }}</td>
                    <td>{{ $d->status_pembayaran }}</td>
                    <td>{{ $d->nominal }}</td>
                    <td>{{ $inv->no_invoice ?? 'Belum Ada' }}</td>
                    <td>{{ $deliv->no_do ?? 'Belum Ada' }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>
