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
                            Token: <strong>{{ $user->user_token }}</strong><br>
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
@endsection
