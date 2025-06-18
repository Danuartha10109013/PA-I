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
                                    <a 
                                    href="javascript:void(0);" 
                                    class="btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#konfirmasiModal" 
                                    data-url="{{ route('admin.pemesanan.active.barus', $d->id) }}">
                                    Activate An Account
                                    </a>

                                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form method="POST" id="konfirmasiForm">
                                            @csrf
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pembeli Baru</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>

                                            <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menyetujui pemesanan ini <br> sebagai pembeli?</p>
                                            <div class="mb-3">
                                                <label for="harga_display" class="form-label">Harga</label>
                                                <input 
                                                type="text" 
                                                id="harga_display" 
                                                class="form-control" 
                                                required 
                                                style="outline: 2px solid #0d6efd;" 
                                                oninput="formatRupiah(this)">
                                                <input type="hidden" name="nominal" id="harga_asli">
                                            </div>
                                            </div>

                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Setujui</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', () => {
                                    const konfirmasiModal = document.getElementById('konfirmasiModal');
                                    const konfirmasiForm = document.getElementById('konfirmasiForm');

                                    konfirmasiModal.addEventListener('show.bs.modal', event => {
                                        const button = event.relatedTarget;
                                        const url = button.getAttribute('data-url');

                                        konfirmasiForm.action = url;

                                        // Reset input saat modal dibuka
                                        document.getElementById('harga_display').value = '';
                                        document.getElementById('harga_asli').value = '';
                                    });

                                    // Format ke Rupiah saat input diketik
                                    window.formatRupiah = function(el) {
                                        let value = el.value.replace(/[^\d]/g, '');
                                        let formatted = new Intl.NumberFormat('id-ID').format(value);
                                        el.value = 'Rp ' + formatted;
                                        document.getElementById('harga_asli').value = value;
                                    };
                                    });
                                    </script>

                                @endif

                                <!-- Delete Button -->
                                <a href="javascript:void(0)" 
                                class="btn btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="{{ $d->id }}">Nonaktif</a>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Nonaktif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin mengnonaktifkan item ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form id="deleteForm" method="POST" action="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Nonaktif</button>
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
