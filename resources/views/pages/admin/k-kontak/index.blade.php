@extends('layouts.admin.main')
@section('title', 'Kelola Kontak || Admin')
@section('pages', 'Kelola Kontak')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Kontak</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Kontak</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Profile</th>
                        <th>Operation Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $d->name }}</td>
                        <td class="align-middle">{{ $d->phone }}</td>
                        <td class="align-middle text-center"><img src="{{asset('storage/kontak/'.$d->profile)}}" width="200px" alt="{{$d->profile}}"></td>
                        <td class="align-middle">{{ $d->operation_time }}</td>
                        <td class="align-middle text-center">
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
                                    <form action="{{ route('admin.k-kontak.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" style="outline: 2px solid grey;" name="name" value="{{ $d->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label> <br>
                                            <small style="color: red;font-size: 12px">* Jangan menggunakan "-" / " " (spasi). Awali dengan +62 bukan 0</small>
                                            <input type="text" class="form-control" style="outline: 2px solid grey;" name="phone" value="{{ $d->phone }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="operation_time" class="form-label">Operation Time</label>
                                            <input type="text" class="form-control" style="outline: 2px solid grey;" name="operation_time" value="{{ $d->operation_time }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="profile" class="form-label">Profile</label>
                                            <input type="file" class="form-control" name="profile" >
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
                                    Are you sure you want to delete user {{ $d->name }}?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.k-kontak.delete', $d->id) }}" method="POST">
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
                <h5 class="modal-title" id="addUserModalLabel">Add Kontak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.k-kontak.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" style="outline: 2px solid grey;" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label> <br>
                        <small style="color: red;font-size: 12px">* Jangan menggunakan "-" / " " (spasi). Awali dengan +62 bukan 0</small>
                        <input type="text" style="outline: 2px solid grey;" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="operation_time" class="form-label">Operation Time</label>
                        <input type="text" style="outline: 2px solid grey;" class="form-control" name="operation_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile</label>
                        <input type="file" class="form-control" name="profile" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Kontak</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
