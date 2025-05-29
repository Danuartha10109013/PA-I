@extends('layouts.admin.main')
@section('title', 'Kelola Produk || Admin')
@section('pages', 'Kelola Produk')

@section('content')
<div class="container">
    <!-- Button to trigger Kategori modal -->
<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
    <i class="fa fa-edit"></i> Kategori
</a>

<!-- Button to trigger Jenis modal -->
<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jenisModal">
    <i class="fa fa-edit"></i> Jenis
</a>

<!-- Kategori Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add new category -->
                <form action="{{ route('admin.product.kategori') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kategoriName" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" style="outline: 2px solid grey;" id="kategoriName" name="nama_kategori" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriDesc" class="form-label">Deskripsi Kategori</label>
                        <textarea class="form-control" style="outline: 2px solid grey;" id="kategoriDesc" name="deskripsi_kategori" rows="3" required></textarea>
                    </div>

                    <!-- Display existing categories -->
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <p>Existing Categories</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$loop->iteration}}</td>
                                        <form action="{{route('admin.product.kategori.edit',$c->id)}}" method="POST" >
                                            @csrf
                                            @method('PUT')
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" value="{{$c->name}}"></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="desc" value="{{$c->deskripsi}}"></td>
                                        <td>
                                            <!-- Add edit and delete buttons as needed -->
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                            </form>
                                            <form action="{{route('admin.product.kategori.delete',$c->id)}}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>


<!-- Jenis Modal -->
<div class="modal fade" id="jenisModal" tabindex="-1" aria-labelledby="jenisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jenisModalLabel">Edit Jenis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.jenis') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenisName" class="form-label">Nama Jenis</label>
                        <input type="text" class="form-control" style="outline: 2px solid grey;" id="jenisName" name="nama_jenis" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisDesc" class="form-label">Deskripsi Jenis</label>
                        <textarea class="form-control" id="jenisDesc" style="outline: 2px solid grey;" name="deskripsi_jenis" rows="3" required></textarea>
                    </div>

                    

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <p>Existing Jenis</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $t)
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$loop->iteration}}</td>
                                        <form action="{{route('admin.product.jenis.edit',$t->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" value="{{$t->name}}"></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="desc" value="{{$t->deskripsi}}"></td>
                                        <td>
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>

                                            <!-- Add edit and delete buttons as needed -->
                                            <form action="" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Produk</h4>

            <div>
                <!-- Button to Filter by Kategori -->
                <button onclick="showFilterKategori()" style="border:none; background:none; cursor: pointer;">
                    <i class="material-symbols-rounded opacity-5">filter</i> Filter Kategori
                </button>
            </div>
            
            <div>
                <!-- Button to Filter by Jenis -->
                <button onclick="showFilterJenis()" style="border:none; background:none; cursor: pointer;">
                    <i class="material-symbols-rounded opacity-5">filter</i> Filter Jenis
                </button>
            </div>
            
            <script>
                // Function to show the Kategori filter modal
                function showFilterKategori() {
                    Swal.fire({
                        title: 'Filter by Kategori',
                        html: 
                            '<ul style="list-style: none; padding: 0;">' +
                            @foreach ($categories as $c)
                                '<li><button class="mb-3 btn btn-primary" onclick="applyFilter(\'/admin/product?filter={{ $c->id }}\')">Kategori {{ $c->name }}</button></li>' +
                            @endforeach
                            '</ul>',
                        showConfirmButton: false
                    });
                }
            
                // Function to show the Jenis filter modal
                function showFilterJenis() {
                    Swal.fire({
                        title: 'Filter by Jenis',
                        html:
                            '<ul style="list-style: none; padding: 0;">' +
                            @foreach ($types as $t)
                                '<li><button class="mb-3 btn btn-primary" onclick="applyFilter(\'/admin/product?filter={{ $t->id }}\')">Jenis {{ $t->name }}</button></li>' +
                            @endforeach
                            '</ul>',
                        showConfirmButton: false
                    });
                }
            
                // Function to apply the selected filter
                function applyFilter(filterUrl) {
                    // Redirect the page to the filter URL
                    window.location.href = filterUrl;
                }
            </script>
            
            
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="material-symbols-rounded">add</i> &nbsp;Add Product</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Gambar</th>
                        <th>Spesifikasi</th>
                        <th>Manual Book</th>
                        <th>Brosur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr class="text-center align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->name }}</td>
                        <td>
                            @php
                                $kategori = \App\Models\KategoriM::find($d->kategori_id);
                                $jenis = \App\Models\JenisM::find($d->jenis_id);
                            @endphp
                            {{$kategori->name}}
                        <td>{{ $jenis->name }}</td>
                        <td class="align-middle">
                            <!-- Slider for Images -->
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
                        </td>
                        <td class="align-middle">
                            <!-- List for Specifications -->
                            @if($d->sfesifikasi)
                                @php
                                    $specifications = json_decode($d->sfesifikasi); // Decode the JSON string into an array
                                @endphp
                                <ul class="list-unstyled">
                                    @foreach ($specifications as $spec)
                                        <li>{{ $spec }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>

                        <td>
                            <a href="{{route('admin.product.download',$d->id)}}" class="btn btn-secondary"><i class="material-symbols-rounded">download</i></a>
                        </td>
                        <td>
                            <a href="{{route('admin.product.downloads',$d->id)}}" class="btn btn-secondary"><i class="material-symbols-rounded">download</i></a>
                        </td>
                        
                        <td class="text-center align-middle">
                         <!-- Edit Button -->
                        <a href="{{route('admin.product.edit',$d->id)}} " class="btn btn-warning"><i class="material-symbols-rounded">edit</i> &nbsp;Edit</a>

                       <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $d->id }}">
                            <i class="material-symbols-rounded">delete</i> &nbsp;Delete
                        </button>

                    </td>
                    </tr>
                    
                    

                    <script>
                        function addSpecification() {
                            const container = document.getElementById('specificationsContainer');
                            const inputGroup = document.createElement('div');
                            inputGroup.classList.add('input-group', 'mb-2');
                            inputGroup.innerHTML = `
                                <input type="text" class="form-control" name="sfesifikasi[]" required>
                                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                            `;
                            container.appendChild(inputGroup);
                        }

                        function removeField(button) {
                            button.closest('.input-group').remove();
                        }

                       
                    </script>

                    <!-- Delete Product Modal -->
                    <div class="modal fade" id="deleteProductModal{{ $d->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.product.delete', $d->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this product?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
                {{-- {{$data->links()}} --}}
            </table>
        </div>
       <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kode_produk" class="form-label">Product Code</label>
                                <input type="text" class="form-control" style="outline: 2px solid grey;" id="kode_produk" name="kode_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" style="outline: 2px solid grey;"  id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" style="outline: 2px solid grey;" name="deskripsi" rows="3" required></textarea>
                            </div>
                            
                            <!-- Dynamic Specifications -->
                            <div class="mb-3">
                                <label class="form-label">Specifications</label>
                                <div id="specificationsContainer">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="sfesifikasi[]"  placeholder="Enter specification" required>
                                        <button type="button" class="btn btn-outline-primary" onclick="addSpecification()">+</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Dynamic Image Uploads -->
                            <div class="mb-3">
                                <label class="form-label">Images</label>
                                <div id="imagesContainer">
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="gambar[]"  accept="image/*" required>
                                        <button type="button" class="btn btn-outline-primary" onclick="addImage()">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_id" class="form-label">Type</label>
                                <select class="form-select" id="jenis_id" style="outline: 2px solid grey;" name="jenis_id" required>
                                    <option value="" selected disabled>Select Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Category</label>
                                <select class="form-select" id="kategori_id" style="outline: 2px solid grey;" name="kategori_id" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="manual_book" class="form-label">Manual Book</label>
                                <input type="file" name="manual_book" id="manual_book" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="brosur" class="form-label">Brosur</label>
                                <input type="file" name="brosur" id="brosur" class="form-control">
                            </div>
                            
                            <!-- Include CKEditor -->
                            <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
                            
                            <script>
                                // Initialize CKEditor on the textarea
                                CKEDITOR.replace('detail');
                            </script>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
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
                    <input type="text" class="form-control" name="sfesifikasi[]" placeholder="Enter specification" required>
                    <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                `;
                container.appendChild(inputGroup);
            }

            function addImage() {
                const container = document.getElementById('imagesContainer');
                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';
                inputGroup.innerHTML = `
                    <input type="file" class="form-control" name="gambar[]" accept="image/*" required>
                    <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                `;
                container.appendChild(inputGroup);
            }

            function removeField(button) {
                button.parentElement.remove();
            }
        </script>


    </div>
</div>
@endsection