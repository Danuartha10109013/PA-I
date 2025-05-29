@extends('layouts.admin.main')
@section('title', 'Kelola Testimoni || Admin')
@section('pages', 'Kelola Testimoni')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Testimoni</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimoniModal">Add Testimoni</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Company Name</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonis as $testimoni)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $testimoni->person_name }}</td>
                        <td>{{ $testimoni->company_name }}</td>
                        <td>{{ $testimoni->product_name }}</td>
                        <td>
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas {{ $i < $testimoni->rating ? 'fa-star text-warning' : 'fa-star text-secondary' }}"></i>
                            @endfor
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTestimoniModal{{ $testimoni->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTestimoniModal{{ $testimoni->id }}">Delete</button>
                        </td>
                    </tr>

                    <!-- Edit Testimoni Modal -->
                    <div class="modal fade" id="editTestimoniModal{{ $testimoni->id }}" tabindex="-1" aria-labelledby="editTestimoniModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTestimoniModalLabel">Edit Testimoni</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="person_name" class="form-label">Customer Name</label>
                                            <input type="text" class="form-control" name="person_name" value="{{ $testimoni->person_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="{{ $testimoni->company_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Product</label>
                                            <input type="text" class="form-control" name="product_name" value="{{ $testimoni->product_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="testimonial" class="form-label">Testimonial</label>
                                            <textarea class="form-control" name="testimonial" rows="3" required>{{ $testimoni->testimonial }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating</label>
                                            <select class="form-control" name="rating" required>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $testimoni->rating == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="person_picture" class="form-label">Customer Picture</label>
                                            <input type="file" class="form-control" name="person_picture">
                                        </div>
                                        <div class="mb-3">
                                            <label for="company_logo" class="form-label">Company Logo</label>
                                            <input type="file" class="form-control" name="company_logo">
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

                    <!-- Delete Testimoni Modal -->
                    <div class="modal fade" id="deleteTestimoniModal{{ $testimoni->id }}" tabindex="-1" aria-labelledby="deleteTestimoniModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteTestimoniModalLabel">Delete Testimoni</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this testimonial by {{ $testimoni->person_name }}?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.testimoni.delete', $testimoni->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Testimoni Modal -->
<div class="modal fade" id="addTestimoniModal" tabindex="-1" aria-labelledby="addTestimoniModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTestimoniModalLabel">Add Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="person_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" name="person_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        @php
                            $produks = \App\Models\ProdukM::all();
                        @endphp
                        <label for="product_name" class="form-label">Product</label>
                        <select type="text" class="form-control" name="product_name" required>
                            <option value="" selected disabled>--Select Product--</option>
                            @foreach ($produks as $produk)
                            <option value="{{$produk->name}}">{{$produk->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="testimonial" class="form-label">Testimonial</label>
                        <textarea class="form-control" name="testimonial" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-control" name="rating" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="person_picture" class="form-label">Customer Picture</label>
                        <input type="file" class="form-control" name="person_picture" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_logo" class="form-label">Company Logo</label>
                        <input type="file" class="form-control" name="company_logo" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Testimoni</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
