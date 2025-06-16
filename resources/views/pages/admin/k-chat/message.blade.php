@extends('layouts.admin.main')
@section('title', 'Kelola Chat || Admin')
@section('pages', 'Kelola Chat')

@section('content')
<style>
    .chat-bubble {
        padding: 10px 15px;
        border-radius: 15px;
        max-width: 75%;
        word-wrap: break-word;
    }

    .chat-user {
        background-color: #e9ecef;
        color: #000;
        border-top-left-radius: 0;
    }

    .chat-admin {
        background-color: #0d6efd;
        color: #fff;
        border-top-right-radius: 0;
    }

    .chat-time {
        font-size: 0.75rem;
        color: #999;
        margin-top: 5px;
    }

    .chat-img {
        max-height: 200px;
        border-radius: 10px;
        margin-top: 5px;
    }

    .chat-container {
        max-height: 400px;
        overflow-y: auto;
        background-color: #f8f9fa;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    .attach-btn {
        background: none;
        border: none;
        color: #0d6efd;
        font-size: 1.5rem;
        cursor: pointer;
    }

    #file-preview img, #file-preview embed {
        max-height: 200px;
        margin-top: 10px;
        border-radius: 10px;
    }
</style>
<!-- Tombol Trigger Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal" title="Setujui Sebagai Pembeli">
    <i class="fa fa-user-plus"></i>
</button>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.pemesanan.active.baru', $user_token) }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembeli Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        @php
            $pesanan = \App\Models\PesananM::where('uuid', $user_token)->first();
            $user = null;
            $pembelian = null;

            if ($pesanan) {
                $user = \App\Models\User::where('email', $pesanan->email)->first();
                if ($user) {
                    $pembelian = \App\Models\PembelianM::where('user_id', $user->id)->first();
                }
            }
        @endphp

        <div class="modal-body">
          @if ($pembelian && $user)
            <div class="alert alert-info text-center">
              <strong>User telah disetujui sebagai pembeli.</strong>
            </div>
          @else
            <p>Apakah Anda yakin ingin menyetujui pemesanan ini sebagai pembeli?</p>

            <div class="mb-3">
              <label for="harga_display" class="form-label">Harga</label>
              <input 
                type="text" 
                id="harga_display" 
                class="form-control" 
                style="outline: 2px solid #0d6efd;" 
                required 
                oninput="formatRupiah(this)">
              <input type="hidden" name="nominal" id="harga_asli">
            </div>
          @endif
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          @if (!$pembelian)
            <button type="submit" class="btn btn-primary">Setujui</button>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function formatRupiah(input) {
    let angka = input.value.replace(/[^,\d]/g, '').toString();
    let split = angka.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    let formatted = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;

    input.value = 'Rp ' + formatted;

    // Simpan angka asli tanpa format
    const angkaBersih = angka.replace(/\D/g, '');
    document.getElementById('harga_asli').value = angkaBersih;
}
</script>


<div class="card">
    <div class="card-header">
        @php
            $pesanan = \App\Models\PesananM::where('uuid',$user_token)->first();
            $product = \App\Models\ProdukM::find($pesanan->product_id);
        @endphp
        <h3 class="card-title">Chat dengan User: <code>{{ $pesanan->name }}</code></h3> Product : {{$product->name}}
    </div>

    <div id="chat-container" class="chat-container">
        @forelse ($messages as $msg)
            <div class="d-flex mb-3 {{ $msg->sender === 'User' ? 'justify-content-start' : 'justify-content-end' }}">
                <div class="chat-bubble {{ $msg->sender === 'User' ? 'chat-user' : 'chat-admin' }}">
                    <strong>{{ $msg->sender }}</strong><br>

                    {{-- File Display --}}
                    @if ($msg->file)
                        @php
                            $ext = strtolower(pathinfo($msg->file, PATHINFO_EXTENSION));
                            $filePath = asset($msg->file);
                        @endphp

                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ $filePath }}" alt="Image" class="chat-img">
                        @elseif ($ext === 'pdf')
                            <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="200px" class="my-2"/>
                        @else
                            <a href="{{ $filePath }}" target="_blank" class="text-white text-decoration-underline d-block my-2">
                                Download: {{ $msg->file }}
                            </a>
                        @endif
                    @endif

                    {{-- Message Text --}}
                    @if ($msg->message)
                        <div>{{ $msg->message }}</div>
                    @endif

                    <div class="chat-time text-end">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada pesan...</p>
        @endforelse
    </div>

    <div class="card-footer">
        <form method="POST" action="{{ route('admin.k-chat.reply') }}" enctype="multipart/form-data" onsubmit="return validateForm()" class="d-flex flex-column gap-2">
            @csrf
            <input type="hidden" name="user_token" value="{{ $user_token }}">
            <input type="hidden" name="sender" value="Admin">

            <div class="d-flex gap-2 align-items-center">
                <input type="text" name="message" id="message" class="form-control flex-grow-1" placeholder="Tulis pesan..." autocomplete="off">
                
                <button type="button" class="attach-btn" onclick="document.getElementById('file').click()">
                    📎
                </button>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>

            <input type="file" name="file" id="file" class="d-none" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt" onchange="handleFileChange()">

            <div id="file-preview"></div>
        </form>
    </div>
</div>

<script>
    function handleFileChange() {
        const fileInput = document.getElementById('file');
        const previewContainer = document.getElementById('file-preview');
        const messageInput = document.getElementById('message');

        previewContainer.innerHTML = '';

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileType = file.type;

            messageInput.disabled = true;
            messageInput.placeholder = 'Kosongkan saat kirim file';

            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="chat-img">`;
                };
                reader.readAsDataURL(file);
            } else if (fileType === 'application/pdf') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = `<embed src="${e.target.result}" type="application/pdf" width="100%" height="200px" />`;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `<p class="text-muted mt-2">File dipilih: ${file.name}</p>`;
            }
        } else {
            messageInput.disabled = false;
            messageInput.placeholder = 'Tulis pesan...';
        }
    }

    function validateForm() {
        const file = document.getElementById('file').value;
        const message = document.getElementById('message').value.trim();

        if (file && message) {
            alert("Anda hanya boleh mengirim pesan atau file, bukan keduanya.");
            return false;
        }

        if (!file && !message) {
            alert("Silakan tulis pesan atau pilih file.");
            return false;
        }

        return true;
    }

    // Auto scroll ke bawah
    document.addEventListener('DOMContentLoaded', () => {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>
@endsection
