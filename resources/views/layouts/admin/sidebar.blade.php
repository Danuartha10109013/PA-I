<div class="sidenav-header">
  <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a class="navbar-brand px-4 py-3 m-0" href="{{ route('admin.dashboard') }}" target="_blank">
      <img src="{{ asset('TSR1.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
      <span class="ms-1 text-sm text-dark">Admin Trisurya</span>
  </a>
</div>
<hr class="horizontal dark mt-0 mb-2">
<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.dashboard') }}">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.product') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.product') }}">
              <i class="material-symbols-rounded opacity-5">inventory_2</i>
              <span class="nav-link-text ms-1">Product</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.rekomendasi') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.rekomendasi') }}">
              <i class="material-symbols-rounded opacity-5">recommend</i>
              <span class="nav-link-text ms-1">Rekomendasi</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.pemesanan') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.pemesanan') }}">
              <i class="material-symbols-rounded opacity-5">orders</i>
              <span class="nav-link-text ms-1">Pemesanan</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.k-pembeli') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.k-pembeli') }}">
              <i class="material-symbols-rounded opacity-5">person</i>
              <span class="nav-link-text ms-1">Pembeli</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.k-admin') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.k-admin') }}">
              <i class="material-symbols-rounded opacity-5">person</i>
              <span class="nav-link-text ms-1">Admin</span>
          </a>
      </li>
      <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Website pages</h6>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.slider') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.slider') }}">
              <i class="material-symbols-rounded opacity-5">sliders</i>
              <span class="nav-link-text ms-1">Slider</span>
          </a>
      </li>
      {{-- <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.customer') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.customer') }}">
              <i class="material-symbols-rounded opacity-5">support_agent</i>
              <span class="nav-link-text ms-1">Customer</span>
          </a>
      </li> --}}
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.project') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.project') }}">
              <i class="material-symbols-rounded opacity-5">tactic</i>
              <span class="nav-link-text ms-1">Project</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.testimoni') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.testimoni') }}">
            <i class="material-symbols-rounded opacity-5">star_rate</i>
            <span class="nav-link-text ms-1">Rating</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.kontak') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.kontak') }}">
              <i class="material-symbols-rounded opacity-5">contacts</i>
              <span class="nav-link-text ms-1">Kontak</span>
          </a>
      </li>
      
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.pesanan') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.pesanan') }}">
              <i class="material-symbols-rounded opacity-5">assignment</i>
              <span class="nav-link-text ms-1">Pembelian</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.about') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.about') }}">
              <i class="material-symbols-rounded opacity-5">apartment</i>
              <span class="nav-link-text ms-1">About Us</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Route::is('admin.k-chat') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.k-chat') }}">
              <i class="material-symbols-rounded opacity-5">chat</i>
              <span class="nav-link-text ms-1">Chats</span>
          </a>
      </li>
  </ul>
</div>
<div class="sidenav-footer position-absolute w-100 bottom-0 ">
  <div class="mx-3">
    <img src="{{asset('TSR.png')}}" class="mb-4 ml-3" width="70%" alt="">
  </div>
</div>
