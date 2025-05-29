<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('TSR1.png')}}">
  <link rel="icon" type="image/png" href="{{asset('TSR1.png')}}">
  <title>
    Login || Admin Dashboard
  </title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{asset('admin')}}/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{asset('admin')}}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{asset('admin')}}/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12"></div>
    </div>
  </div>
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <div class="col-4"></div>
                    <div class="col-5 text-center px-1">
                      <img src="{{asset('TSRr.png')}}" style="width: 100%" alt="">
                    </div>
                    <div class="col-2"></div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="{{route('login-proses')}}" class="text-start" method="POST">
                  @csrf
                  <!-- Success Alert -->
                  @if (session('success'))
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 3000
                      });
                    });
                  </script>
                  @endif

                  <!-- Error Alert -->
                  @if (session('error'))
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        showConfirmButton: false,
                        timer: 3000
                      });
                    });
                  </script>
                  @endif

                  <!-- Validation Errors Alert -->
                  @if ($errors->any())
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>',
                        showConfirmButton: true
                      });
                    });
                  </script>
                  @endif

                  <!-- Form Fields -->
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email or Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          
        </div>
      </footer>
    </div>
  </main>
  <!-- Core JS Files -->
  <script src="{{asset('admin')}}/assets/js/core/popper.min.js"></script>
  <script src="{{asset('admin')}}/assets/js/core/bootstrap.min.js"></script>
  <script src="{{asset('admin')}}/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{asset('admin')}}/assets/js/plugins/smooth-scrollbar.min.js"></script>
  {{-- <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> --}}
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Control Center for Material Dashboard -->
  <script src="{{asset('admin')}}/assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>
