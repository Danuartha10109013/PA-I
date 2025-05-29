@extends('layouts.admin.main')
@section('title', 'Kelola Pesanan || Admin')
@section('pages', 'Kelola Produk')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="fw-bolder" style="font-size: 24px">Kelola Pesanan</h1>
            <div class="d-flex justify-content-between w-100">
                <a href="{{ route('admin.pemesanan.export') }}" class="btn btn-warning"><i class="fa fa-download"></i> Export</a>
                <!-- Search Form -->
                <form action="{{ route('admin.pemesanan') }}" method="GET" class="d-flex">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control me-5" 
                        placeholder="Search by Name or Company" 
                        value="{{ request('search') }}" 
                    />
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
            

            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Produk Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>No WhatsApp</th>
                            <th>Company Name</th>
                            <th>Alamat</th>
                            <th>Company Email</th>
                            <th>Orders</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $d)
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$loop->iteration}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->created_at}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                @php
                                    $product = \App\Models\ProdukM::where('id',$d->product_id)->value('name');
                                @endphp
                                {{$product}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->name}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->email}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->whatsapp}} <a href="{{route('admin.pemesanan.message',$d->id)}}" class="btn btn-success"><i class="fab fa-whatsapp"></i>                                Message</a></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->company_name}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->alamat_perusahaan}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$d->email_perusahaan}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Pesanan Ke-{{$d->total_order}}</td>
                            <td>
                                @php
                                    $count = \App\Models\User::where('email',$d->email)->count();
                                @endphp
                                @if ($count >= 1)
                                    Account Has Been Created
                                @else
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal" data-url="{{ route('admin.pemesanan.active', $d->id) }}">
                                    Activate An Account
                                </a>
                                @endif

                                <!-- Delete Button -->
                                <a href="javascript:void(0)" 
                                class="btn btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="{{ $d->id }}">Hapus</a>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus item ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form id="deleteForm" method="POST" action="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const deleteModal = document.getElementById('deleteModal');
                                        deleteModal.addEventListener('show.bs.modal', function (event) {
                                            const button = event.relatedTarget; // Button that triggered the modal
                                            const id = button.getAttribute('data-id'); // Extract id from data-* attribute
                                            const form = deleteModal.querySelector('#deleteForm');
                                            form.action = `{{ route('admin.pemesanan.delete', '') }}/${id}`;
                                        });
                                    });
                                </script>
                                


                                <!-- Confirmation Modal -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to activate this account?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" id="confirmForm">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Yes, Activate</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', () => {
                                        const confirmModal = document.getElementById('confirmModal');
                                        const confirmForm = document.getElementById('confirmForm');
                                        
                                        confirmModal.addEventListener('show.bs.modal', event => {
                                            // Button that triggered the modal
                                            const button = event.relatedTarget;
                                            const url = button.getAttribute('data-url');
                                            
                                            // Update the form action
                                            confirmForm.action = url;
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
