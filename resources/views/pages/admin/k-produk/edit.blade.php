@extends('layouts.admin.main')
@section('title', 'Edit Produk || Admin')
@section('pages', 'Edit Produk')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Edit Produk || {{ $data->name }}</h4>
        </div>
        
        <!-- Product Edit Form -->
        <form action="{{ route('admin.product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kode_produk" class="form-label">Product Code</label>
                <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="{{ $data->kode_produk }}" required style="outline: 2px solid grey;">
            </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required style="outline: 2px solid grey;">
            </div>
            
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Description</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required style="outline: 2px solid grey;">{{ $data->deskripsi }}</textarea>
            </div>
            
            <!-- Dynamic Specifications -->
            <div class="mb-3">
                <label class="form-label">Specifications</label>
                <div id="specificationsContainer">
                    @php
                        $spek = json_decode($data->sfesifikasi);
                        $img = json_decode($data->gambar);
                    @endphp
                    @foreach ($spek as $specification)
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="sfesifikasi[]" value="{{ $specification }}" placeholder="Enter specification" required>
                            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                        </div>
                    @endforeach
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="sfesifikasi[]" placeholder="Enter specification">
                        <button type="button" class="btn btn-outline-primary" onclick="addSpecification()">+</button>
                    </div>
                </div>
            </div>
            
            <!-- Dynamic Image Uploads -->
            <div class="mb-3">
                <label class="form-label">Images <br> <small style="color: red">*   Jika menambahkan file baru, file sebelumnnya hilang</small></label>
                <div id="imagesContainer">
                    @foreach ($img as $image)
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="gambar[]" value="{{$image}}" accept="image/*">
                            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                        </div>
                    @endforeach
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="gambar[]" accept="image/*">
                        <button type="button" class="btn btn-outline-primary" onclick="addImage()">+</button>
                    </div>
                </div>
            </div>


            
            <div class="mb-3">
                <label for="jenis_id" class="form-label">Type</label>
                <select class="form-select" id="jenis_id" name="jenis_id" required style="outline: 2px solid grey;">
                    <option value="" selected disabled>Select Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $data->jenis_id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Category</label>
                <select class="form-select" id="kategori_id" name="kategori_id" required style="outline: 2px solid grey;">
                    <option value="" selected disabled>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $data->kategori_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10">{{ old('detail', $data->detail ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="manual_book" class="form-label">Manual Book</label> <p>Recent Files : {{$data->manual_book ?? ''}}</p>
                <input type="file" name="manual_book" id="manual_book" class="form-control">
            </div>
            <div class="mb-3">
                <label for="brosur" class="form-label">Brosur</label> <p>Recent Files : {{$data->brosur ?? ''}}</p>
                <input type="file" name="brosur" id="brosur" class="form-control">
            </div>
            
            <!-- Include CKEditor -->
            <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
            
            <script>
                // Initialize CKEditor on the textarea
                CKEDITOR.replace('detail');
            </script>
            
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Adding More Fields -->
<script>
    function addSpecification() {
        const container = document.getElementById('specificationsContainer');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" class="form-control" name="sfesifikasi[]" placeholder="Enter specification">
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
        `;
        container.appendChild(inputGroup);
    }

    function addImage() {
        const container = document.getElementById('imagesContainer');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="file" class="form-control" name="gambar[]" accept="image/*">
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
        `;
        container.appendChild(inputGroup);
    }

    function removeField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
