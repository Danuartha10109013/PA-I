<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan</title>
</head>
<body>
    <h2>Halo, {{ $nama }}</h2>

    @if( $produk )
    <p>Terima kasih telah melakukan pemesanan. Berikut adalah detail pemesanan Anda:</p>

    <ul>
        <li><strong>Produk:</strong> {{ $produk }}</li>
        <li><strong>Harga:</strong> Rp {{ number_format($harga, 0, ',', '.') }}</li>
    </ul>

    <p>Silakan lakukan proses pemesanan & pembayaran Anda pada sistem kami.</p>

    @else
    <p>Terima kasih telah mendaftar dan percaya pada sistem kami</p>

    <p>Berikut informasi akun Anda untuk login ke sistem kami:</p>

    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>Silakan login dan lanjutkan pemesanan Anda.</p>
    @endif
    <p>Salam,<br>Tim Kami</p>
</body>
</html>
