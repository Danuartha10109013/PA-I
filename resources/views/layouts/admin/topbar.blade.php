<div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('pages')</li>
      </ol>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group input-group-outline">
          
        </div>
      </div>
      <ul class="navbar-nav d-flex align-items-center justify-content-end">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-center" target="_blank" href="{{ route('landing-page') }}">
            <i class="material-symbols-rounded fixed-plugin-button-nav">home</i>
          </a>
        </li>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
            <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
          </a>
        </li>
        <li class="nav-item dropdown d-flex align-items-center">
          <a href="#" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::user()->profile)
            <img src="{{ asset('storage/' . Auth::user()->profile)}}" class="rounded-circle" alt="Profile" width="30" height="30">
            @else
            <i class="material-symbols-rounded">account_circle</i>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                <i class="material-symbols-rounded me-2">edit</i> Edit Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logouts') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-symbols-rounded me-2">logout</i> Logout
              </a>
              <form id="logout-form" action="{{ route('logouts') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>