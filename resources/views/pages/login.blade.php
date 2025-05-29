@extends('layouts.main')

@section('title', 'Login - PT. Trisurya Solusindo Utama')

@section('content')
<style>
    /* Background styling */
    body {
        /* background: linear-gradient(135deg, #6e8efb, #a777e3); */
        display: flex;
        /* align-items: center; */
        justify-content: center;
        height: 100vh;
    }
    .container{

    }

    /* Card styling */
    .login-card {
        
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideDown 0.6s ease-out;
    }

    /* Form styling */
    .login-card input {
        height: 45px;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.3s ease;
    }
    
    .login-card input:focus {
        border-color: #6e8efb;
        box-shadow: 0px 0px 8px rgba(110, 142, 251, 0.5);
    }

    /* Button styling */
    .login-btn {
        height: 50px;
        background: #6e8efb;
        color: white;
        border-radius: 10px;
        border: none;
        transition: background 0.3s ease;
    }

    .login-btn:hover {
        background: #a777e3;
    }

    /* Animation for card */
    @keyframes slideDown {
        from {
            transform: translateY(-20%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card login-card shadow-lg border-0">
                <div class="card-header bg-gradient-primary-to-secondary text-white text-center">
                    <h3 class="fw-bold mt-2 mb-0">Welcome Back</h3>
                    <p class="text-light mt-1">Log in to continue</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('login-proses') }}" method="POST">
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
                        <!-- Username -->
                        <div class="form-group mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn login-btn btn-lg">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    {{-- <small class="text-muted">Forgot your password? <a href="{{ route('password.request') }}" class="text-decoration-none">Click here</a></small> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
