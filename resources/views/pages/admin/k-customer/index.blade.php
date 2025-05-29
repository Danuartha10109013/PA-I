@extends('layouts.admin.main')
@section('title', 'Kelola Customer || Admin')
@section('pages', 'Kelola Customer')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Customer</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Customer</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td class="align-middle" >&nbsp;&nbsp;&nbsp;&nbsp;{{ $loop->iteration }}</td>
                        <td class="align-middle">&nbsp;&nbsp;&nbsp;&nbsp;{{ $d->name }}</td>
                        <td class="align-middle">&nbsp;&nbsp;&nbsp;&nbsp;{{ $d->company_name }}</td>
                        <td class="align-middle">
                            <img src="{{ asset('storage/' . $d->logo) }}" width="30%" alt="{{ $d->logo }}">
                        </td>
                        <td class="align-middle">&nbsp;&nbsp;&nbsp;&nbsp;{{ $d->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td class="align-middle">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $d->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $d->id }}">Delete</button>
                        </td>
                    </tr>
                    
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal{{ $d->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.k-customer.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $d->name }}"
                                            style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                                            onblur="this.style.outline='none';" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="{{ $d->company_name }}" 
                                            style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                                            onblur="this.style.outline='none';" required>
                                        </div>
                                       
                                        <div class="mb-3">
                                            <label for="active" class="form-label">Active</label>
                                            <select class="form-control" name="status" style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                                            onblur="this.style.outline='none';" required>
                                                <option value="1" {{ $d->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $d->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="Logo" class="form-label">Logo</label>
                                            <input type="file" class="form-control mb-2" style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                                            onblur="this.style.outline='none';" name="logo" >
                                            <label for="Logo" class="form-label">Current Logo </label>
                                            <img src="{{asset('storage/'.$d->logo)}}" width="30%"  alt="{{$d->logo}}">
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

                    <!-- Delete User Modal -->
                    <div class="modal fade" id="deleteUserModal{{ $d->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete customer {{ $d->company_name }}?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.k-customer.delete', $d->id) }}" method="POST">
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.k-customer.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" 
                        style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                        onblur="this.style.outline='none';" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control"
                        style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                        onblur="this.style.outline='none';"  name="company_name"  required>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">Active</label>
                        <select class="form-control" name="status" style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                        onblur="this.style.outline='none';"  required>
                            <option value="" selected disabled>--Pilih Status--</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" style="outline: none; border: 1px solid #ccc;"onfocus="this.style.outline='3px solid red';" 
                        onblur="this.style.outline='none';"  required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
