@extends('layouts.main')
@section('title', 'PT. Trisurya Solusindo Utama || Pesanan')

@section('content')
<div class="container px-5 pb-5 mt-5">
    <h1 class="fw-bold mb-4 text-center" style="font-size: 32px; color: #ff4e50;" data-aos="fade-down">
        Pesanan
    </h1>
    
    <div class="row" data-aos="fade-up" data-aos-duration="1000">
        <!-- Product Detail Section -->
        <div class="col-md-4">
            <h5 class="text-center">Product Detail</h5>
            <div class="card h-100 shadow-sm border-0">
                @if($data->product_id)
                    @php
                        $produk = \App\Models\ProdukM::find($data->product_id);
                        $images = json_decode($produk->gambar);
                    @endphp
                    <div id="carousel{{ $produk->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ Storage::url($image) }}" class="d-block w-100 card-img-top" style="object-fit: cover; height: 250px;" alt="Product Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $produk->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $produk->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif

                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-2">{{ $produk->name }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($produk->deskripsi, 20, '...') }}</p>
                </div>
            </div>
        </div>

        <!-- Order Status Section -->
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center">Order Status</h5>
                    <div class="alert alert-info text-center" role="alert">
                        {{ $data->status }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Proof of Payment Section -->
                    <div class="row">
                        
                        <div class="col-md-4">
                            <h5 class="text-center">Invoice</h5>
                            @php
                                $filePath = storage_path('app/' . $data->invoice);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            <div class="text-center">
                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <img src="{{ asset('storage/' . $data->invoice) }}" alt="invoice" style="width: 100px; height: auto;" class="rounded">
                                @elseif($fileExtension === 'pdf')
                                    <a href="{{ asset('storage/' . $data->invoice) }}" target="_blank" class="btn btn-danger">View PDF</a>
                                    @elseif($fileExtension === 'docx')
                                    <a href="{{ asset('storage/' . $data->invoice) }}" target="_blank" class="btn btn-secondary">Download File</a>
                                @else
                                <p>Document not Available</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">Dokumen DO</h5>
                            @php
                                $filePath = storage_path('app/' . $data->no_do);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            <div class="text-center">
                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <img src="{{ asset('storage/' . $data->no_do) }}" alt="no_do" style="width: 100px; height: auto;" class="rounded">
                                @elseif($fileExtension === 'pdf')
                                    <a href="{{ asset('storage/' . $data->no_do) }}" target="_blank" class="btn btn-danger">View PDF</a>
                                    @elseif($fileExtension === 'docx')
                                    <a href="{{ asset('storage/' . $data->no_do) }}" target="_blank" class="btn btn-secondary">Download File</a>
                                @else
                                <p>Document not Available</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">Faktur Pajak</h5>
                            @php
                                $filePath = storage_path('app/' . $data->faktur);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            <div class="text-center">
                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <img src="{{ asset('storage/' . $data->faktur) }}" alt="faktur" style="width: 100px; height: auto;" class="rounded">
                                @elseif($fileExtension === 'pdf')
                                    <a href="{{ asset('storage/' . $data->faktur) }}" target="_blank" class="btn btn-danger">View PDF</a>
                                @elseif($fileExtension === 'docx')
                                    <a href="{{ asset('storage/' . $data->faktur) }}" target="_blank" class="btn btn-secondary">Download File</a>
                                @else
                                <p>Document not Available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                        
                        
                        
                        
                        
                </div>
            </div>
        </div>
        

        
    </div>

    <!-- Add Testimonial Section -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="200">
        <div class="col-md-8 offset-md-2">
            <h2 class="fw-bold text-center mb-4" style="font-size: 28px; color: #007bff;">Add Customer Testimoni</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('pembeli.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Customer Name -->
                        <div class="mb-3">
                            <label for="person_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="person_name" value="{{Auth::user()->name}}" placeholder="Enter customer name" readonly>
                        </div>

                        <!-- Company Name -->
                        <div class="mb-3">
                            @php
                                $company_name = \App\Models\PesananM::where('email',Auth::user()->email)->value('company_name')
                            @endphp
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" placeholder="Enter company name" value="{{$company_name}}" readonly>
                        </div>

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product</label>
                            <input type="text" class="form-control" name="product_name" value="{{$produk->name}}" placeholder="Enter product name" readonly>
                        </div>

                        <!-- Testimonial -->
                        <div class="mb-3">
                            <label for="testimonial" class="form-label">Testimonial</label>
                            <textarea class="form-control" name="testimonial" rows="3" placeholder="Enter testimonial" required></textarea>
                        </div>

                        
                        

                        <!-- Customer Picture -->
                        <div class="mb-3">
                            <label for="person_picture" class="form-label">Customer Picture</label>
                            <input type="file" class="form-control" name="person_picture" required>
                        </div>

                        <!-- Company Logo -->
                        <div class="mb-3">
                            <label for="company_logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" name="company_logo" required>
                        </div>

                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="star-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" title="{{ $i }} stars">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        
                        <style>
                            .star-rating {
                                display: flex;
                                flex-direction: row-reverse;
                                justify-content: center;
                                gap: 5px;
                            }
                        
                            .star-rating input {
                                display: none;
                            }
                        
                            .star-rating label {
                                font-size: 24px;
                                color: #ccc;
                                cursor: pointer;
                                transition: color 0.2s ease-in-out;
                            }
                        
                            .star-rating input:checked ~ label {
                                color: #ffcc00;
                            }
                        
                            .star-rating label:hover,
                            .star-rating label:hover ~ label {
                                color: #ffcc00;
                            }
                        </style>

                        <!-- Submit Buttons -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Testimoni</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
@endsection


