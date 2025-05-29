<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export CSV</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>TimeStamp</th>
                <th>Name</th>
                <th>Email</th>
                <th>WhatsApp</th>
                <th>Company Name</th>
                <th>Alamat Perusahaan</th>
                <th>Email Perusahaan</th>
                <th>Product Id</th>
                <th>Total Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->created_at}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->whatsapp}}</td>
                <td>{{$d->company_name}}</td>
                <td>{{$d->alamat_perusahaan}}</td>
                <td>{{$d->email_perusahaan}}</td>
                <td>
                    @php
                        $pname = \App\Models\ProdukM::find($d->product_id);
                    @endphp
                    {{$pname->name}}</td>
                <td>{{$d->total_order}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>