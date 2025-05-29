@extends('layouts.admin.main')
@section('title', 'Kelola Produk || Admin')
@section('pages', 'Kelola Produk')

@section('content')
<div class="container">

<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Produk</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Spesifikasi</th>
                        <th>Gambar</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr class="text-center align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->kategori_id }}</td>
                        <td>{{ $d->jenis_id }}</td>
                        <td>{{ $d->harga }}</td>
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
                        
                        <td class="text-center align-middle">
                            @if ($d->rekomendasi == 0)
                            <button 
                                class="btn btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmationModal" 
                                data-action="{{ route('admin.k-rekomendasi.active', $d->id) }}"
                                data-message="Are you sure you want to set this as Active?">
                                <i class="fa fa-times"></i> Nonactive
                            </button>
                            @else
                            <button 
                                class="btn btn-success" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmationModal" 
                                data-action="{{ route('admin.k-rekomendasi.nonactive', $d->id) }}"
                                data-message="Are you sure you want to set this as Nonactive?">
                                <i class="fa fa-check"></i> Active
                            </button>
                            @endif
                        </td>
                        
                        <!-- Confirmation Modal -->
                        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="confirmationMessage"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form id="confirmationForm" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const confirmationModal = document.getElementById('confirmationModal');
                                const confirmationMessage = document.getElementById('confirmationMessage');
                                const confirmationForm = document.getElementById('confirmationForm');

                                confirmationModal.addEventListener('show.bs.modal', (event) => {
                                    const button = event.relatedTarget; // Button that triggered the modal
                                    const action = button.getAttribute('data-action'); // Extract the action route
                                    const message = button.getAttribute('data-message'); // Extract the confirmation message

                                    // Update modal message and form action
                                    confirmationMessage.textContent = message;
                                    confirmationForm.setAttribute('action', action);
                                });
                            });
                                
                            </script>                        
                    </tr>
                    
                    @endforeach
                </tbody>
                {{-- {{$data->links()}} --}}
            </table>
        </div>
       

    </div>
</div>
@endsection