@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Testimoni
@endsection

@section('content')
<div class="container px-5 pb-5">
    <h1 class="fw-bold text-center mb-4" style="font-size: 32px; animation: fadeInDown 1s ease-out; color: #007bff;">
        <i class="fas fa-comments"></i> Testimoni Pelanggan
    </h1>
    <div class="row gy-4">
        @foreach ($testimonials as $testimonial)
            <div class="col-md-6 col-lg-4" style="animation: slideIn 1.5s ease-out; animation-delay: {{ $loop->index * 0.2 }}s; animation-fill-mode: both;">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <!-- Customer Image and Company Logo -->
                        <div class="d-flex align-items-center mb-3">
                            <div style="width: 60px; height: 60px; overflow: hidden; border-radius: 50%; border: 2px solid #007bff;">
                                <img src="{{ asset('storage/testimoni/'.$testimonial->person_picture) }}" alt="Person Picture" class="img-fluid">
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold mb-0">{{ $testimonial->person_name }}</h5>
                                <p class="text-muted mt-1" style="font-size: 12px">{{ $testimonial->company_name }}</p>
                            </div>
                            <div class="ms-auto">
                                <img src="{{ asset('storage/testimoni/'.$testimonial->company_logo) }}" alt="Company Logo" style="width: 100px; height: auto;" >
                            </div>
                        </div>
                        
                        <!-- Product and Testimonial -->
                        <h6 class="fw-bold text-primary">{{ $testimonial->product_name }}</h6>
                        <p class="text-muted">{{ $testimonial->testimonial }}</p>

                        <!-- Star Rating with Animation -->
                        <div class="d-flex align-items-center stars">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="{{ $i < $testimonial->rating ? 'fas' : 'far' }} fa-star star" style="--star-index: {{ $i }};"></i>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Custom CSS -->
<style>
/* Card Slide-in Animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Star Fill Animation */
.stars .star {
    color: lightgray;
    font-size: 18px;
    animation: fillStar 4s ease forwards;
    animation-delay: calc(var(--star-index) * 0.2s);
}

.stars .fas {
    color: transparent;
}

/* Star fill effect */
@keyframes fillStar {
    0% {
        color: lightgray;
    }
    100% {
        color: gold;
    }
}

/* Card hover effect */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
</style>
@endsection
