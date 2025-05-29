@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Kontak
@endsection
@section('content')

<!-- Include AOS library CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<div class="container px-5 pb-5">
    <div class="py-5" style="background: linear-gradient(to right, #ff4e50, #1c92d2); color: white; border-radius: 15px;">
        <h2 class="text-center mb-4 fw-bold" style="text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">
            <i class="fas fa-address-book"></i> Kontak Kami
        </h2>
        <div class="row gy-4 justify-content-center">
            @foreach ($data as $kontak)
                <div class="col-md-4 d-flex justify-content-center" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card h-100 shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-3">
                                <img src="{{ asset('storage/kontak/' . $kontak->profile) }}" alt="{{ $kontak->name }}" 
                                    class="rounded-circle shadow" 
                                    style="width: 200px; height: 200px; object-fit: cover; border: 5px solid white;">
                            </div>
                            <h5 class="fw-bold text-primary">{{ $kontak->name }}</h5>
                            <p class="mb-1 text-dark"><i class="fas fa-phone-alt text-success"></i> {{ $kontak->phone }}</p>
                            <p class="mb-1 text-dark"><i class="fas fa-clock text-warning"></i> {{ $kontak->operation_time }}</p>
                        </div>
                        <div class="card-footer text-center" style="background: rgba(0, 0, 0, 0.05);">
                            <a href="https://api.whatsapp.com/send?phone={{ $kontak->phone }}&text=Halo%20PT.%20Trisurya%20Solusindo%20Utama%2C%20saya%20ingin%20bertanya%20terkait%20produk." 
                                target="_blank" 
                                class="btn btn-success">
                                 <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                             </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Map Section -->
    <div class="mt-5" data-aos="zoom-in" data-aos-duration="1500">
        <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body">
                <h2 class="fw-bold text-center" style="font-size: 28px; color: #007bff;">
                    <i class="fas fa-map-marker-alt"></i> Lokasi Kami
                </h2>
                <p class="text-center text-muted mt-3">Lihat lokasi kami pada peta di bawah:</p>
                <div class="map-container mt-4" style="position: relative;">
                    <iframe 
                        src="{{$link_map}}" 
                        width="100%" 
                        height="400" 
                        style="border: 0; border-radius: 15px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <!-- Map Shadow Decoration -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; box-shadow: 0px 0px 20px rgba(0,0,0,0.3); border-radius: 15px; pointer-events: none;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    AOS.init(); // Initialize AOS animations
</script>

@endsection
