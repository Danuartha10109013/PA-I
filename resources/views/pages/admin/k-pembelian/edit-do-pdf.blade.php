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
    <div class="do-title">EDIT DELIVERY ORDER</div>

    <form action="{{ route('admin.pesanan.savedo', $data->no_do) }}" method="POST" enctype="multipart/form-data">
      @csrf
<input type="hidden" name="pembeli_id" value="{{$data->pembeli_id}}">
      <!-- DO Info Table -->
      <table class="do-info">
        <tr>
          <td style="background: #cce5ff">DO No</td>
          <td><input type="text" name="nomor_do" value="{{ $data->no_do }}" readonly></td>
        </tr>
        <tr>
          <td style="background: #cce5ff">Ref No PO</td>
          <td><input type="text" name="no_ref" value="{{ $data->no_ref }}" readonly></td>
        </tr>
        <tr>
          <td style="background: #cce5ff">Date</td>
          <td><input type="date" name="date" value="{{ $data->date }}"></td>
        </tr>
      </table>

      <!-- TO Section -->
      <table class="to-table">
        <thead><tr><th>TO:</th></tr></thead>
        <tbody>
          <tr><td><strong><input type="text" name="pt_penerima" value="{{ $data->pt_penerima }}"></strong></td></tr>
          <tr><td><input type="text" name="alamat" value="{{ $data->alamat }}"></td></tr>
        </tbody>
      </table>

      <!-- Item Table -->
      <table class="description-table">
        <thead>
          <tr><th>No</th><th>Description</th><th>Qty</th></tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>
              <input type="text" name="product" value="{{ $data->product }}"><br />
              <input type="text" name="description" value="{{ $data->description }}">
            </td>
            <td>
              <input type="number" name="qty" min="1" value="{{ $data->qty }}" required> Unit
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" style="text-align: center; font-weight: bold">Total</td>
            <td id="total_qty" style="text-align: center; font-weight: bold">{{ $data->total_qty }} Unit</td>
          </tr>
        </tfoot>
      </table>

      <!-- Notes -->
      <table class="note-table">
        <thead><tr><th>Note</th></tr></thead>
        <tbody>
          <tr><td>Franco: <input type="text" name="franco" value="{{ $data->franco }}"></td></tr>
          <tr><td>Warranty: <input type="number" name="waranty" value="{{ $data->waranty }}"> years</td></tr>
        </tbody>
      </table>

      <!-- Signatures -->
      <div class="signatures">
        <div class="signature-block">
          Customer,<br><br>
          <img id="customer_preview" src="{{ $data->customer_signature ? asset('storage/'.$data->customer_signature) : '' }}"
               style="max-height: 80px; margin-bottom: -40px; display: {{ $data->customer_signature ? 'block' : 'none' }}">
          <div class="signature-line"></div>
          <input type="file" name="customer_signature" accept="image/*" onchange="previewSignature(this, 'customer_preview')">
          <input type="text" name="customer_name" value="{{ $data->customer_name }}">
        </div>

        <div class="signature-block">
          Best Regards,<br><br>
          <img id="best_preview" src="{{ $data->best_regards_signature ? asset('storage/'.$data->best_regards_signature) : '' }}"
               style="max-height: 80px; margin-bottom: -40px; display: {{ $data->best_regards_signature ? 'block' : 'none' }}">
          <div class="signature-line"></div>
          <input type="file" name="best_regards_signature" accept="image/*" onchange="previewSignature(this, 'best_preview')">
          <input type="text" name="best_regards" value="{{ $data->best_regards }}">
        </div>
      </div>

      <!-- Submit Button -->
      <div style="margin-top: 30px; text-align: center;">
        <button type="submit" class="btn btn-primary">Update Delivery Order</button>
      </div>
    </form>

    <!-- Footer -->
    <div class="footer">
      If you have any questions about this DO, please contact<br>
      <strong>WA: 0821 2360 2409</strong>, info@trisuryasolusindo.com
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Tampilkan preview tanda tangan
    function previewSignature(input, previewId) {
      const preview = document.getElementById(previewId);
      const file = input.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    }

    // Update total qty otomatis
    document.addEventListener("DOMContentLoaded", function () {
      const qtyInput = document.querySelector('input[name="qty"]');
      const totalQtyCell = document.getElementById("total_qty");

      if (qtyInput && totalQtyCell) {
        qtyInput.addEventListener("input", function () {
          const qty = parseInt(this.value) || 0;
          totalQtyCell.textContent = qty + " Unit";
        });
      }
    });
  </script>
</body>

</html>
