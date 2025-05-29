@extends('layouts.main')

@section('title')
Access Denied || PT. Trisurya Solusindo Utama
@endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="alert alert-danger" role="alert" style="font-size: 1.5rem;">
            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
            <h3 class="fw-bold">Access Denied</h3>
            <p>You do not have permission to view this page.</p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3" data-aos="fade-in" data-aos-duration="1000">Go Back</a>
    </div>
</div>

<script>
    AOS.init();
</script>

<style>
    /* Full viewport height */
    .container-fluid {
        height: 100vh;
        background: linear-gradient(135deg, #ff0000, #0000ff); /* Red and Blue gradient */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .alert {
        background: linear-gradient(135deg, #ff6f6f, #6c63ff); /* Soft Red and Blue gradient */
        border-radius: 15px;
        padding: 3rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transform: scale(0.8);
        animation: scaleUp 1s forwards;
        color: white;
    }

    @keyframes scaleUp {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Font Awesome icon style */
    .fas {
        color: #ffffff;
    }

    /* Button fade-in animation */
    .btn-primary[data-aos="fade-in"] {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
