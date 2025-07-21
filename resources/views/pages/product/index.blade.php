@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Product
@endsection
@section('content')
<style>
.testimoni-item {
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}
.testimoni-item:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}
.stars {
    cursor: pointer;
    transition: background 0.3s ease;
}
.stars:hover {
    background: #6c757d !important;
}
</style>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('bg1.png')}}" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('bg2.png')}}" alt="...">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container px-5 pb-5 mt-5">
    <div class="row align-items-center justify-content-between mb-4 p-3 border rounded shadow-sm bg-light">
        <!-- Categories on the Left with Horizontal Scrolling -->
        <div class="col-md-4">
            <div class="d-flex gap-2 overflow-auto" style="white-space: nowrap;">
                <a class="btn btn-outline-primary {{ request('category') == 'rekomendasi' ? 'active' : '' }}" 
                    style="font-size: 15px;" 
                    href="{{ route('product', ['category' => 'rekomendasi', 'search' => request('search')]) }}">
                     Rekomendasi
                 </a>
                @foreach ($category as $c)
                <a class="btn btn-outline-primary {{ request('category') == $c->name ? 'active' : '' }}" 
                   style="font-size: 15px;" 
                   href="{{ route('product', ['category' => $c->name, 'search' => request('search')]) }}">
                    {{ $c->name }}
                </a>
                @endforeach
            </div>
        </div>
    
        <!-- Centered Title -->
        <div class="col-md-4 text-center">
            <h1 class="fw-bold text-dark mb-4 mt-4" style="font-size: 24px;">Product Gallery</h1>
        </div>
    
        <!-- Search Form on the Right -->
        <div class="col-md-4 text-end">
            <form action="{{ route('product') }}" method="GET" class="d-flex align-items-center justify-content-end" style="gap: 10px;">
                <input type="text" name="search" placeholder="Search Products" class="form-control" value="{{ $search }}" style="width: 250px; border-radius: 20px;">
                <input type="hidden" name="category" value="{{ request('category') }}"> <!-- Retain category value -->
                <button class="btn btn-success px-4" type="submit" style="border-radius: 20px;">Search</button>
            </form>
        </div>
    </div>
    
    
    
    <section class="py-5">

        <div class="container px-4 px-lg-5">
            <div class="row  justify-content-center">
                @foreach ($data as $d)
                
                    <div class="col-4 mb-5">
                        <div class="card h-100 shadow-sm border-1">
                            <!-- Product image carousel -->
                            @if($d->gambar)
                                @php
                                    $images = json_decode($d->gambar);
                                @endphp
                                <div id="carousel{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($image) }}" class="d-block w-100 card-img-top" style="object-fit: cover; height: 250px;" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                            <!-- Product details -->
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="d-flex align-items-center justify-content-center mb-2 stars  rounded p-1 ps-3 pe-3" style="width: fit-content;background: #495057;cursor:pointer" onclick="showTestimoniModal('{{ $d->id }}')" data-bs-toggle="modal"  data-bs-target="#testimoniModal">
                                        
                                    <i class="bi bi-eye text-white"></i> &nbsp; 
                                    
                                    @if(!empty($testimoni[$d->id]))
                                            @php
                                                $ratings = array_column($testimoni[$d->id], 'rating');

                                                $average = count($ratings) > 0 ? array_sum($ratings) / count($ratings) : 0;
                                            @endphp
                                            
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="bi bi-star{{ $i < $average ? '-fill' : '' }} fs-4 text-warning" style="--star-index: 0;" aria-hidden="true"></i>
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="bi bi-star fs-4 text-warning" style="--star-index: 0;" aria-hidden="true"></i>
                                            @endfor
                                        @endif
                                    </a>
                                </div>
                                <h5 class="card-title fw-bold mb-2">{{ $d->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($d->deskripsi, 20, '...') }}</p>
                            </div>
                            <!-- Product actions -->
                            <div class="card-footer bg-transparent border-top-0">
                                <!-- Button to trigger the modal -->
                                <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productModal-{{ $d->id }}">Lihat Produk</a>

                                <!-- Fullscreen Modal -->
                                <div class="modal fade" id="productModal-{{ $d->id }}" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="productModalLabel">Product Name : {{ $d->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Carousel for product images -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @if($d->gambar)
                                                            @php
                                                                $images = json_decode($d->gambar); // Decode the JSON string into an array
                                                            @endphp
                                                            <div id="carousel{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach ($images as $index => $image)
                                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                            <img src="{{ Storage::url($image) }}" class="d-block w-100" alt="Product Image">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <!-- Carousel Controls -->
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                            
                                                    <!-- Product Information Section -->
                                                    <div class="col-md-6">
                                                        <div class="container">
                                                            <div class="row">
                                                                <!-- Product Description -->
                                                                <div class="col-12 col-lg-12 text-center">
                                                                    <div class="mt-4 ">
                                                                        <h4 class="fw-bold text-dark">Description</h4>
                                                                        <p class="text-muted">{{ $d->deskripsi }}</p>
                                                                    </div>
                                                                    <!-- Product Specifications -->
                                                                    @if($d->sfesifikasi)
                                                                        @php
                                                                            $specifications = json_decode($d->sfesifikasi);
                                                                        @endphp
                                                                        <h5 class="fw-bold">Specifications</h5>
                                                                        @php
                                                                        $columns = collect($specifications)->chunk(3); // Membagi array menjadi grup dengan 3 elemen per grup
                                                                        @endphp
                                                                        
                                                                        <div class="row">
                                                                            @foreach ($columns as $index => $group)
                                                                                <div class="col-12 @if($columns->count() > 2 && $index == $columns->count() - 1) text-center @else col-md-6 @endif">
                                                                                    <ul class="list-group list-group-flush" id="list-group-{{ $index }}">
                                                                                        @foreach ($group as $value)
                                                                                            <li class="list-group-item" >
                                                                                                <strong><i class="fa-solid fa-check" style="color: #007bff; font-weight: bold;"></i></strong> {{ $value }}
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                            
                                                                <!-- Price and Specifications Section -->
                                                                <div class="col-12 col-lg-12 mt-3">
                                                                    <div style="width: 100%; border: 1px solid #ccc; padding: 10px; box-sizing: border-box;">
                                                                        <style>
                                                                            table {
                                                                                border-collapse: collapse;
                                                                                width: 100%;
                                                                            }
                                                                            table, th, td {
                                                                                outline: 1px solid grey;
                                                                            }
                                                                        </style>
                                                                        {!! $d->detail !!}
                                                                    </div>
                                                                    
                                                                    
                                            
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12 text-center">
                                                                <a href="{{route('product.manual_book',$d->id)}}" class="btn btn-secondary"><i class="fa fa-download"></i> Download Manual Book</a>
                                                                <a href="{{route('product.brosur',$d->id)}}" class="btn btn-primary"><i class="fa fa-download"></i> Download Brosur</a>
                                                                <a href="{{route('product.whatsapp',$d->id)}}" class="btn btn-success"><i class="fa fa-comment"></i> Pesan Sekarang</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    
</div>

<!-- Modal Testimoni -->
<div class="modal fade" id="testimoniModal" tabindex="-1" aria-labelledby="testimoniModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testimoniModalLabel">Detail Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="testimoniModalBody">
                <!-- Konten akan diisi via JavaScript -->
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function showTestimoniModal(productId) {
    const modalBody = document.getElementById('testimoniModalBody');
    modalBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`;
    
    fetch(`/get-testimoni/${productId}`)
        .then(response => response.json())
        .then(testimonials => {
            let html = '';
            
            if(testimonials.length > 0) {
                // Calculate average rating
                const validRatings = testimonials.map(t => {
                    // Pastikan rating sebagai number
                    const rating = Number(t.rating);
                    // Return null jika invalid
                    return (rating >= 1 && rating <= 5) ? rating : null;
                }).filter(r => r !== null);

                const sum = validRatings.reduce((a, b) => a + b, 0);
                const average = validRatings.length > 0 ? sum / validRatings.length : 0;
                
                // Display average rating section
                html += `
                <div class="text-center mb-4 p-3 bg-light rounded">
                    <h4>Rating Rata-rata</h4>
                    <div class="d-flex justify-content-center mb-2">
                        ${Array(5).fill().map((_, i) => 
                            `<i class="bi bi-star${i < average ? '-fill' : ''} fs-2 text-warning mx-1"></i>`
                        ).join('')}
                    </div>
                    <h5 class="mb-0">${average.toFixed(1)} dari 5 (${testimonials.length} ulasan)</h5>
                </div>
                <hr>
                `;
                
                // Display each testimonial
                testimonials.forEach(testimonial => {
                    const starIcons = Array(5).fill().map((_, i) => 
                        `<i class="bi bi-star${i < testimonial.rating ? '-fill' : ''} text-warning"></i>`
                    ).join('');
                    
                    const personPicture = testimonial.person_picture ? 
                        `<img src="{{ asset('storage/testimoni/') }}/${testimonial.person_picture}" 
                              alt="${testimonial.person_name}" 
                              class="rounded-circle me-3" 
                              style="width: 60px; height: 60px; object-fit: cover;">` :
                        `<div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" 
                              style="width: 60px; height: 60px;">
                            <i class="bi bi-person-fill text-white fs-4"></i>
                        </div>`;
                    
                    const companyLogo = testimonial.company_logo ? 
                        `<img src="{{ asset('storage/testimoni/') }}/${testimonial.company_logo}" 
                              alt="${testimonial.company_name || 'Company Logo'}" 
                              class="ms-auto" 
                              style="max-height: 40px; max-width: 120px;">` :
                        `<span class="ms-auto text-muted">${testimonial.company_name || ''}</span>`;
                    
                    html += `
                    <div class="testimoni-item mb-4 p-3 border rounded">
                        <div class="d-flex align-items-center mb-3">
                            ${personPicture}
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="fs-5">${testimonial.person_name || 'Anonim'}</strong>
                                    ${companyLogo}
                                </div>
                                ${testimonial.company_name ? `<small class="text-muted d-block">${testimonial.company_name}</small>` : ''}
                            </div>
                        </div>
                        <div class="mb-2">
                            ${starIcons}
                            <small class="text-muted ms-2">${new Date(testimonial.created_at).toLocaleDateString('id-ID')}</small>
                        </div>
                        <p class="mb-0">${testimonial.testimonial || 'Tidak ada komentar tambahan'}</p>
                    </div>
                    `;
                });
            } else {
                html = `
                <div class="text-center py-4">
                    <i class="bi bi-chat-square-text fs-1 text-muted mb-3"></i>
                    <h5>Belum ada testimoni untuk produk ini</h5>
                    <p class="text-muted">Jadilah yang pertama memberikan ulasan</p>
                </div>`;
            }
            
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i> Gagal memuat testimoni. Silakan coba lagi.
            </div>`;
            console.error('Error:', error);
        });
}
</script>

@endsection
