<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Delivery Order</title>
  <style>
    @page {
      size: A4;
      margin: 0;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 297mm;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .container {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 20mm;
      box-sizing: border-box;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }

    .logo {
      width: 80px;
    }

    .company-details {
      text-align: right;
      font-size: 10px;
      line-height: 1.4;
    }

    .company-name {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 2px;
    }

    .slogan {
      font-size: 11px;
      margin-bottom: 4px;
    }

    .do-title {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      text-decoration: none;
      margin-bottom: 20px;
      margin-right: 75px
    }

    .do-info {
      width: 50%;
      margin-left: auto;
      font-size: 12px;
      border-collapse: collapse;
    }

    .do-info td {
      border: 1px solid #000;
      padding: 5px;
    }

    .to-table {
      width: 30%;
      border-collapse: collapse;
      font-size: 12px;
      margin-top: 20px;
    }

    .to-table th {
      background-color: #cce5ff;
      border: 1px solid #000;
      text-align: left;
      padding: 5px;
      width: 30%;
    }

    .to-table td {
      border: none;
      padding: 4px 0;
    }

    .description-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 12px;
    }

    .description-table th,
    .description-table td {
      border: 1px solid #000;
      padding: 6px;
    }

    .description-table th {
      background-color: #cce5ff;
      text-align: center;
    }

    .description-table td:nth-child(1) {
      width: 5%;
      text-align: center;
    }

    .description-table td:nth-child(3) {
      width: 10%;
      text-align: center;
    }

    .note-table {
      width: 50%;
      font-size: 12px;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .note-table th {
      background-color: #cce5ff;
      border: 1px solid #000;
      text-align: left;
      padding: 5px;
    }

    .note-table td {
      border: none;
      padding: 4px 0;
    }

    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 50px;
      font-size: 12px;
    }

    .signature-block {
      width: 40%;
      text-align: center;
    }

    .signature-line {
      border-top: 1px solid #000;
      margin-top: 60px;
      width: 70%;
      margin-left: auto;
      margin-right: auto;
    }

    .footer {
      margin-top: auto;
      text-align: center;
      font-size: 10px;
      padding-top: 20px;
    }

    .footer strong {
      color: blue;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <img src="{{ asset('TSR1.png') }}" alt="Logo" class="logo" />
      <div class="company-details">
        <div class="company-name">PT. TRISURYA SOLUSINDO UTAMA</div>
        <div class="slogan">Weighing Solution and System Integrator</div>
        Head Office: Ruko Poris Residence Blok A2 No 17, Tangerang - Banten<br />
        Marketing Office: Jl. Ciliwung 6 No.66, Lippo Cikarang, Kab. Bekasi - Jawa Barat 17530<br />
        Hotline: 0821 2360 2409, email: info@trisuryasolusindo.com<br />
        www.trisuryasolusindo.com
      </div>
    </div>

    <!-- Title -->
    <div class="do-title">DELIVERY ORDER</div>

    <!-- Form Start -->

      <!-- DO Info Table -->
      <table class="do-info">
        <tr>
          <td style="background: #cce5ff">DO No</td>
          <td>{{$data->no_do}}</td>
        </tr>
        <tr>
          <td style="background: #cce5ff">Ref No PO</td>
          <td>{{$data->no_ref}}</td>
        </tr>
        <tr>
          <td style="background: #cce5ff">Date</td>
          <td>{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</td>

        </tr>
      </table>

      <!-- TO Section -->
      <table class="to-table">
        <thead>
          <tr><th>TO:</th></tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>{{$data->pt_penerima}}</strong></td>
          </tr>
          <tr>
            <td>{{$data->alamat}}</td>
          </tr>
        </tbody>
      </table>

      <!-- Item Table -->
      <table class="description-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Description</th>
            <th>Qty</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>
              {{$data->product}}<br />
              {{$data->description}}
            </td>
            <td>
              {{$data->qty}} Unit
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" style="text-align: center; font-weight: bold">Total</td>
            <td id="total_qty" style="text-align: center; font-weight: bold">{{$data->total_qty}} Unit</td>
          </tr>
        </tfoot>
      </table>

      <!-- Notes -->
      <table class="note-table">
        <thead>
          <tr><th>Note</th></tr>
        </thead>
        <tbody>
          <tr><td>Franco: {{$data->franco}}</td></tr>
          <tr><td>Warranty: {{$data->waranty}} years</td></tr>
        </tbody>
      </table>

      <!-- Signatures -->
      <div class="signatures">
        <div class="signature-block">
          Customer,<br><br>
          <img  src="{{asset('storage/'.$data->customer_signature)}}" style="max-height: 80px;margin-bottom: -40px">
          <div class="signature-line"></div>
          {{$data->customer_name}}
        </div>
        <div class="signature-block">
          Best Regards,<br><br>
          <img  src="{{asset('storage/'.$data->best_regards_signature)}}" style="max-height: 80px;margin-bottom: -40px">
          <div class="signature-line"></div>
          {{$data->best_regards}}
        </div>
      </div>

<div class="print-hide" style="text-align: center; margin-bottom: 20px;">
  @if(Auth::user()->role == 0)
  <a href="{{ route('admin.pesanan') }}" class="button-back">Go Back</a>
  @else
  <a href="{{ route('pembeli.pesanan') }}" class="button-back">Go Back</a>
  @endif
</div>

<style>
  @media print {
    .print-hide {
      display: none !important;
    }
  }

  .button-back {
    margin-top: 40px;
    display: inline-block;
    padding: 8px 16px;
    background-color: #ccc;
    color: #000;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
  }

  .button-back:hover {
    background-color: #999;
  }
</style>


    <!-- Footer -->
    <div class="footer">
      If you have any questions about this DO, please contact<br>
      <strong>WA: 0821 2360 2409</strong>, info@trisuryasolusindo.com
    </div>
  </div>



  <!-- JavaScript -->
  
</body>
</html>
