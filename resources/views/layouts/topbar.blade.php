<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5">
        <a class="navbar-brand" href="{{ route('landing-page') }}">
            <img class="fw-bolder text-primary" src="{{ asset('TSR1.png') }}" width="50" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul style="font-size: 16px" class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('landing-page') ? 'active' : '' }}" href="{{ route('landing-page') }}" aria-current="page">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('product') ? 'active' : '' }}" href="{{route('product')}}">Produk Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('customer') ? 'active' : '' }}" href={{route('customer')}}>Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('testimoni') ? 'active' : '' }}" href={{route('testimoni')}}>Rating</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('kontak') ? 'active' : '' }}" href="{{route('kontak')}}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('project') ? 'active' : '' }}" href="{{route('project')}}">Project</a>
                </li>
                @if (Auth::user())
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('pembeli.pesanan') ? 'active' : '' }}" href="{{route('pembeli.pesanan')}}">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                </li>
            </ul>
        </div>
        
    </div>
</nav>