<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Invoice</title>
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

    .description-table td:nth-child(2) {
      width: 15%;
      text-align: center;
    }

    .description-table td:nth-child(3) {
      width: 15%;
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
      margin-top: 30px;
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
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <img src="{{ public_path('TSR1.png') }}" alt="Logo" class="logo" />
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
    <div class="do-title">INVOICE</div>

    <!-- DO Info Table -->
    <table class="do-info">
      <tr>
        <td style="background: #cce5ff">Invoice No</td>
        <td>{{$data->no_invoice}}</td>
      </tr>
      <tr>
        <td style="background: #cce5ff">NO Ref</td>
        <td>{{$data->no_ref}}</td>
      </tr>
      <tr>
        <td style="background: #cce5ff">Invoice Date</td>
        <td>{{$data->date}}</td>
      </tr>
      <tr>
        <td style="background: #cce5ff">Due Date</td>
        <td>{{$data->due_date}}</td>
      </tr>
    </table>

    <!-- TO Section -->
    <table class="to-table">
      <thead>
        <tr><th>TO:</th></tr>
      </thead>
      <tbody>
        <tr><td><strong>{{$data->pt_penerima}}</strong></td></tr>
        <tr><td>{{$data->alamat}}</td></tr>
      </tbody>
    </table>

    <!-- Item Table -->
    <table class="description-table">
      <thead>
        <tr>
          <th>DESCRIPTION</th>
          <th>QTY</th>
          <th>PRICE</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            {{$data->product}}<br />
            {{$data->description}}
          </td>
          <td>
            {{$data->qty}} Unit
          </td>
          <td>
            Rp. {{ number_format($data->price, 0, ',', '.') }}
          </td>
        </tr>
        <tr>
          <td></td>
          <td><strong>TOTAL</strong></td>
          <td>Rp. {{ number_format($data->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td></td>
          <td><strong>DPP Lain</strong></td>
          <td>Rp. {{ number_format($data->dpp, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td></td>
          <td><strong>VAT</strong></td>
          <td>Rp. {{ number_format($data->vat, 0, ',', '.') }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" style="text-align: center; font-weight: bold">Grand Total</td>
          <td>Rp. {{ number_format($data->grand_total, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>

    <!-- Notes -->
    <table class="note-table">
      <thead>
        <tr><th>Our Bank Detail</th></tr>
      </thead>
      <tbody>
        <tr><td><strong>PT. TRISURYA SOLUSINDO UTAMA</strong></td></tr>
        <tr><td>Bank Account No: {{$data->bank_account}}</td></tr>
        <tr><td>Bank - {{$data->bank_name}} Cabang Lippo Cikarang</td></tr>
      </tbody>
    </table>

    <!-- Signatures -->
    <div class="signatures">
      <div class="hidden"></div>
      <div class="signature-block">
        <div class="date">Cikarang , {{ \Carbon\Carbon::parse($data->date_kirim)->format('d M Y') }}</div>
        Best Regards,<br><br>
        <img src="{{ public_path('storage/' . $data->best_regards_signature) }}" style="max-height: 80px; margin: 10px auto; display:block;">
        <div class="signature-line" style="margin-top: -5px"></div>
        {{$data->best_regards}} 
      </div>
    </div>

    

  </div>
</body>
</html>
