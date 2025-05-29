@extends('layouts.main')

@section('title')
PT. Trisurya Solusindo Utama || Customer
@endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<div class="container px-5 pb-5 mt-5">
    <h1 class="fw-bold mb-4 text-center" style="font-size: 32px; color: #ff4e50;" data-aos="fade-down">
        Customer
    </h1>
    <div class="row gx-2 gy-2 justify-content-center"> <!-- Reduced gap -->
        @foreach ($data as $d)
        <div class="col-md-3" data-aos="fade-up"> <!-- Increased card size -->
            <div class="card text-center border-0 shadow-sm position-relative hover-animate">
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                    <!-- Paragraf di dalam card -->
                    <p class="m-0 fw-bold" style="color: #333; font-size: 1.2rem;">{{ $d->company_name }}</p>
                    <img src="{{ asset('storage/'.$d->logo) }}" class="img-fluid logo-image mt-2" alt="{{ $d->company_name }}">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    AOS.init();
</script>

<style>
    /* Styling for the cards */
    .card {
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        border: 2px solid #ff4e50; /* Outline color */
        background: transparent; /* Remove background */
        height: 200px; /* Increased height */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Ensures proper spacing between p and img */
    }

    .logo-image {
        max-height: 120px; /* Adjust logo size */
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: shadow for logo */
        border-radius: 8px; /* Optional: rounded corners */
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .card:hover img {
        transform: scale(1.1);
    }

    /* Adjust gap between rows and columns */
    .row.gx-2 {
        margin-left: -0.25rem;
        margin-right: -0.25rem;
    }

    .row.gy-2 > [class*="col-"] {
        margin-bottom: 1rem; /* Slightly larger gap for rows */
    }

    /* Hover animation */
    .hover-animate:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
</style>
@endsection
