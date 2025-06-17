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
    <div class="do-title">INVOICE</div>

    <!-- Form Start -->
    <form action="{{ route('admin.pesanan.saveinvoice') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <input type="hidden" name="pembeli_id" value="{{ $data->pembeli_id }}">

  <!-- DO Info Table -->
  <table class="do-info">
    <tr>
      <td style="background: #cce5ff">DO No</td>
      <td><input type="text" name="no_invoice" value="{{ $data->no_invoice }}" readonly></td>
    </tr>
    <tr>
      <td style="background: #cce5ff">Ref No PO</td>
      <td><input type="text" name="no_ref" value="{{ $data->no_ref }}" readonly></td>
    </tr>
    <tr>
      <td style="background: #cce5ff">Invoice Date</td>
      <td><input type="date" name="date" value="{{ $data->date }}" required></td>
    </tr>
    <tr>
      <td style="background: #cce5ff">Due Date</td>
      <td><input type="date" name="due_date" value="{{ $data->due_date }}" required></td>
    </tr>
  </table>

  <!-- TO Section -->
  <table class="to-table">
    <thead>
      <tr><th>TO:</th></tr>
    </thead>
    <tbody>
      <tr><td><strong><input type="text" name="pt_penerima" value="{{ $data->pt_penerima }}" required></strong></td></tr>
      <tr><td><input type="text" name="alamat" value="{{ $data->alamat }}" required></td></tr>
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
          <input type="text" name="product" value="{{ $data->product }}" required><br />
          <input type="text" name="description" value="{{ $data->description }}" required>
        </td>
        <td>
          <input type="number" name="qty" id="qty" min="1" value="{{ $data->qty }}" required> Unit
        </td>
        <td>
          <input type="number" name="price" id="price" min="1" value="{{ $data->price }}" required oninput="calculateTotals()"><br>
          <small id="price_rp"></small>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><strong>TOTAL</strong></td>
        <td>
          <input type="text" id="total" name="total" value="{{ $data->total }}" readonly required>
          <br><small id="total_rp"></small>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><strong>DPP Lain</strong></td>
        <td>
          <input type="text" id="dpp" name="dpp" value="{{ $data->dpp }}" readonly>
          <br><small id="dpp_rp"></small>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><strong>VAT</strong></td>
        <td>
          <input type="text" id="vat" name="vat" value="{{ $data->vat }}" readonly>
          <br><small id="vat_rp"></small>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2" style="text-align: center; font-weight: bold">Grand Total</td>
        <td>
          <input type="text" id="grand_total" name="grand_total" value="{{ $data->grand_total }}" readonly required>
          <br><small id="grand_rp"></small> 
        </td>
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
      <tr><td>Bank Account No: <input type="number" name="bank_account" value="{{ $data->bank_account }}" required></td></tr>
      <tr><td>Bank - <input type="text" name="bank_account_name" value="{{ $data->bank_name }}" required> Cabang Lippo Cikarang</td></tr>
    </tbody>
  </table>

  <!-- Signatures -->
  <div class="signatures">
    <div class="hidden"></div>
    <div class="signature-block">
      <div class="date">Cikarang , <input type="date" name="date_kirim" value="{{ $data->date_kirim }}"></div>
      Best Regards,<br><br>
      <div class="signature-line"></div>
      <input type="file" name="best_regards_signature" accept="image/*" onchange="previewSignature(this, 'bestregards_preview')"><br>
      @if ($data->best_regards_signature)
        <img id="bestregards_preview" src="{{ asset('storage/' . $data->best_regards_signature) }}" style="max-height: 80px; margin: 10px auto; display:block;">
      @else
        <img id="bestregards_preview" src="" style="max-height: 80px; display:none; margin: 10px auto;">
      @endif
      <input type="text" name="best_regards" value="{{ $data->best_regards }}" placeholder="Your Name">
    </div>
  </div>

  <!-- Submit Button -->
  <div style="margin-top: 30px; text-align: center;">
    <button type="submit" class="btn btn-primary">Update Invoice</button>
  </div>
</form>


    <!-- Footer -->
    
  </div>
<script>
  function previewSignature(input, previewId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.style.display = 'none';
    }
  }
</script>

  <!-- JavaScript -->
 <script>
  function formatRupiah(angka) {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      minimumFractionDigits: 0
    }).format(angka);
  }

  function calculateTotals() {
    const qty = parseFloat(document.getElementById("qty").value) || 0;
    const price = parseFloat(document.getElementById("price").value) || 0;

    const total = qty * price;
    const vat = price * 0.11;
    const dpp = price * 11 / 12;
    const grandTotal = price + vat;

    // Set nilai input
    document.getElementById("total").value = total.toFixed(0);
    document.getElementById("vat").value = vat.toFixed(0);
    document.getElementById("dpp").value = dpp.toFixed(0);
    document.getElementById("grand_total").value = grandTotal.toFixed(0);

    // Format Rupiah
    document.getElementById("price_rp").innerText = formatRupiah(price);
    document.getElementById("total_rp").innerText = formatRupiah(total);
    document.getElementById("vat_rp").innerText = formatRupiah(vat);
    document.getElementById("dpp_rp").innerText = formatRupiah(dpp);
    document.getElementById("grand_rp").innerText = formatRupiah(grandTotal);
  }

  // Panggil saat halaman dimuat untuk hitungan awal
  window.addEventListener('DOMContentLoaded', calculateTotals);
</script>

</body>

</html>
