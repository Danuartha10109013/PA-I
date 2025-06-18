@extends('layouts.admin.main')
@section('title', 'Daftar Chat User || Admin')
@section('pages', 'Daftar Chat User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengguna yang Menghubungi</h3>
    </div>
    <div class="card-body">
        @if ($userTokens->isEmpty())
            <p>Tidak ada pesan masuk.</p>
        @else
            <ul class="list-group">
                @foreach ($userTokens as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-person-circle me-2"></i>
                            @php
                                $pesanan = \App\Models\PesananM::where('uuid',$user->user_token)->first();
                            @endphp
                            @if($pesanan)
                                Name: <strong>{{ $pesanan->name }}</strong>
                                <span id="dot-{{ $user->user_token }}" class="badge bg-danger rounded-circle ms-1 d-none"
                                    style="width:5px; height:10px;">&nbsp;</span>
                                Email: <strong>{{ $pesanan->email }}</strong><br>
                            @endif
                            <small class="text-muted">Last chat: {{ \Carbon\Carbon::parse($user->last_chat)->diffForHumans() }}</small>
                        </span>
                        <a href="{{ route('admin.k-chat.message', $user->user_token) }}" class="btn btn-sm btn-primary">
                            Lihat Chat
                        </a>
                    </li>


                @endforeach
            </ul>
        @endif
    </div>
</div>
<script>
    const lastSeenChats = {}; // Simpan ID terakhir saat pertama load

    function fetchLastSeen() {
        fetch('/chat/latest-id')
            .then(response => response.json())
            .then(data => {
                // Simpan semua last seen saat pertama kali load
                for (const token in data) {
                    lastSeenChats[token] = data[token];
                }
            });
    }

    function checkNewChats() {
        fetch('/chat/latest-id')
            .then(response => response.json())
            .then(data => {
                for (const token in data) {
                    const dot = document.getElementById('dot-' + token);
                    if (lastSeenChats[token] !== undefined && data[token] > lastSeenChats[token]) {
                        dot.classList.remove('d-none');
                    } else {
                        dot.classList.add('d-none');
                    }
                }
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchLastSeen();
        setInterval(checkNewChats, 1000); // Cek setiap 10 detik
    });
</script>

@endsection
