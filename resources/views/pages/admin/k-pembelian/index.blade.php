@extends('layouts.admin.main')
@section('title', 'Kelola Pembelian || Admin')
@section('pages', 'Kelola Pembelian')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Pembelian</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Invoice</th>
                        <th>No DO</th>
                        <th>Faktur Pajak</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data)
                    @foreach ($data as $d)
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $loop->iteration }}</td>
                        <td>
                            @php
                                $user = \App\Models\User::find($d->user_id);
                                $produk = \App\Models\ProdukM::find($d->product_id);
                            @endphp
                            @if ($user)
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}
                            @else
                                &nbsp;&nbsp;&nbsp;&nbsp;User not found
                            @endif
                        </td>
                        <td>
                            @if ($produk)
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $produk->name}}</td>
                            @else
                            &nbsp;&nbsp;&nbsp;&nbsp;Produk not found
                            @endif
                            
                        <td>&nbsp;&nbsp;&nbsp;{{ $d->status }}</td>
                        
                        <td>
                            @php
                                $filePath = storage_path('app/' . $d->invoice); // Adjust according to where the file is stored
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp
                        
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <!-- Display Image Preview -->
                                <img src="{{ asset('storage/' . ($d->invoice)) }}" alt="invoice" style="width: 100px; height: auto;">
                            @elseif(in_array($fileExtension, ['pdf']))
                                <!-- Display PDF Link -->
                                <a href="{{ asset('storage/' . ($d->invoice)) }}" target="_blank">View PDF</a>
                            @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                                <!-- Display Document Link -->
                                <a href="{{ asset('storage/' . ($d->invoice)) }}" target="_blank">Download Document</a>
                            @else
                                <!-- For other file types, show a generic link -->
                                <a href="{{ asset('storage/' . ($d->invoice)) }}" target="_blank">Download File</a>
                            @endif
                        </td>
                        <td>
                            @php
                                $filePath = storage_path('app/' . $d->no_do); // Adjust according to where the file is stored
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp
                        
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <!-- Display Image Preview -->
                                <img src="{{ asset('storage/' . ($d->no_do)) }}" alt="no_do" style="width: 100px; height: auto;">
                            @elseif(in_array($fileExtension, ['pdf']))
                                <!-- Display PDF Link -->
                                <a href="{{ asset('storage/' . ($d->no_do)) }}" target="_blank">View PDF</a>
                            @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                                <!-- Display Document Link -->
                                <a href="{{ asset('storage/' . ($d->no_do)) }}" target="_blank">Download Document</a>
                            @else
                                <!-- For other file types, show a generic link -->
                                <a href="{{ asset('storage/' . ($d->no_do)) }}" target="_blank">Download File</a>
                            @endif
                        </td>
                        <td>
                            @php
                                $filePath = storage_path('app/' . $d->faktur); // Adjust according to where the file is stored
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp
                        
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <!-- Display Image Preview -->
                                <img src="{{ asset('storage/' . ($d->faktur)) }}" alt="faktur" style="width: 100px; height: auto;">
                            @elseif(in_array($fileExtension, ['pdf']))
                                <!-- Display PDF Link -->
                                <a href="{{ asset('storage/' . ($d->faktur)) }}" target="_blank">View PDF</a>
                            @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                                <!-- Display Document Link -->
                                <a href="{{ asset('storage/' . ($d->faktur)) }}" target="_blank">Download Document</a>
                            @else
                                <!-- For other file types, show a generic link -->
                                <a href="{{ asset('storage/' . ($d->faktur)) }}" target="_blank">Download File</a>
                            @endif
                        </td>
                        
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $d->id }}">Edit</button>
                        </td>
                    </tr>
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal{{ $d->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Status Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.pesanan.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                        <label for="active" class="form-label">Status</label>
                                            <select style="outline: 2px solid grey;" class="form-control" name="product" required>
                                                <option value="" disabled>--Select Status--</option>
                                                    <option value="Belum Disiapkan" {{ $d->status == "PO" ? 'selected' : '' }}>PO</option>
                                                    <option value="Dikemas" {{ $d->status == "Dikemas" ? 'selected' : '' }}>Dikemas</option>
                                                    <option value="Dikirim" {{ $d->status == "Dikirim" ? 'selected' : '' }}>Dikirim</option>
                                                    <option value="Selesai" {{ $d->status == "Selesai" ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        
                                        <div class="container">

                                            <div class="mb-3">
                                            
                                            <div class="mb-3">
                                                <label for="po" class="form-label">Invoice</label>
                                                <input type="file" name="invoice" class="form-control" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="po" class="form-label">No Do</label>
                                                <input type="file" name="no_do" class="form-control" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="po" class="form-label">Faktur Pajak</label>
                                                <input type="file" name="faktur" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <tr>
                        <td>Data Belom Ada</td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Pembelian Selesai</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data1)
                    @foreach ($data1 as $d)
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $loop->iteration }}</td>
                        <td>
                            @php
                                $user = \App\Models\User::find($d->user_id);
                                $produk = \App\Models\ProdukM::find($d->product_id);
                            @endphp
                            @if ($user)
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $user->name }}
                            @else
                                &nbsp;&nbsp;&nbsp;&nbsp;User not found
                            @endif
                        </td>
                        <td>
                            @if ($produk)
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $produk->name}}</td>
                            @else
                            &nbsp;&nbsp;&nbsp;&nbsp;Produk not found
                            @endif
                            
                        <td>&nbsp;&nbsp;&nbsp;{{ $d->status }}</td>
                        <td>
                            @php
                                $filePath = storage_path('app/' . $d->bukti); // Adjust according to where the file is stored
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp
                        
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <!-- Display Image Preview -->
                                <img src="{{ asset('storage/' . ($d->bukti)) }}" alt="Bukti" style="width: 100px; height: auto;">
                            @elseif(in_array($fileExtension, ['pdf']))
                                <!-- Display PDF Link -->
                                <a href="{{ asset('storage/' . ($d->bukti)) }}" target="_blank">View PDF</a>
                            @elseif(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                                <!-- Display Document Link -->
                                <a href="{{ asset('storage/' . ($d->bukti)) }}" target="_blank">Download Document</a>
                            @else
                                <!-- For other file types, show a generic link -->
                                <a href="{{ asset('storage/' . ($d->bukti)) }}" target="_blank">Download File</a>
                            @endif
                        </td>
                        
                    </tr>
                    
                    @endforeach
                    @else
                    <tr>
                        <td>Data Belom Ada</td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
