@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Pesan Product
@endsection
@section('content')
<div class="container">
    <h1 class="fw-bold text-center" style="font-size: 24px">Lengkapi Data Diri / Perusahaan</h1>
    
        <form action="{{route('product.whatsapp.send')}}" method="POST">
            @csrf
            <div class="row mt-5">
                <div class="col-md-4">
                    <h5 class="text-center">Product Detail</h5>
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Product image carousel -->
                        @if($data->gambar)
                            @php
                                $images = json_decode($data->gambar);
                            @endphp
                            <div id="carousel{{ $data->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($image) }}" class="d-block w-100 card-img-top" style="object-fit: cover; height: 250px;" alt="Product Image">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $data->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $data->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                        <!-- Product details -->
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-2">{{ $data->name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($data->deskripsi, 20, '...') }}</p>
                        </div>
                        <!-- Product actions -->
                        <div class="card-footer bg-transparent border-top-0">
                            <!-- Button to trigger the modal -->
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-control mb-3">
                        <label for="nama"><i class="fas fa-user"></i> Nama <small style="color: red">*</small></label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" >
                    </div>
                    
                    <div class="form-control mb-3">
                        <label for="email"><i class="fas fa-envelope"></i> Email <small style="color: red">*</small></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" >
                    </div>
                    
                    <div class="form-control mb-3">
                        <label for="no_whatsapp"><i class="fab fa-whatsapp"></i> No WhatsApp <small style="color: red">*</small></label>
                        <input type="text" name="no_whatsapp" class="form-control" id="no_whatsapp" placeholder="Masukkan No WhatsApp" required>
                    </div>
                </div>
                
                
                <div class="col-md-4">
                    <div class="form-control mb-3">
                        <label for="perusahaan"><i class="fas fa-building"></i> Perusahaan <small style="color: red">*</small></label>
                        <input type="text" name="perusahaan" class="form-control" id="perusahaan" placeholder="Masukkan Nama Perusahaan" required>
                    </div>
                    
                    <div class="form-control mb-3">
                        <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat <small style="color: red">*</small></label>
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat Perusahaan" >
                    </div>
                    
                    <div class="form-control mb-3">
                        <label for="email_perusahaan"><i class="fas fa-building"></i> Email Perusahaan <small style="color: red">*</small></label>
                        <input type="email" name="email_perusahaan" class="form-control" id="email_perusahaan" placeholder="Masukkan Email Perusahaan" >
                    </div>
                </div>
                
                <input type="hidden" name="prodct_id" value="{{$data->id}}">

                <div class="col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-success"><i class="fa-brands fa-whatsapp"></i> Send To WhatsApp</button>
                </div>
            </div>
        </form>
</div>
@endsection
