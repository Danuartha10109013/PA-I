@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Product
@endsection
@section('content')
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
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($data as $d)
                    <div class="col mb-5">
                        <div class="card h-100 shadow-sm border-0">
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
                                                                <a href="{{route('product.whatsapp',$d->id)}}" class="btn btn-success"><i class="fa-brands fa-whatsapp"></i> Pesan Sekarang</a>
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

@endsection
