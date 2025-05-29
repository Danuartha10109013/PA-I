@extends('layouts.admin.main')
@section('title', 'Kelola Slider || Admin')
@section('pages', 'Kelola Slider')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Slider</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Slider</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td class="align-middle text-center"><img src="{{asset('storage/slider/'.$d->image)}}" width="200px" alt="{{$d->profile}}"></td>
                        <td class="align-middle text-center">
                            <button class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#editUserModal{{ $d->id }}">Edit</button>
                            <button class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $d->id }}">Delete</button>
                        </td>
                    </tr>
                    
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal{{ $d->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit Slider</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete user {{ $d->name }}?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.k-slider.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('put')
                                        <p>
                                            Existing Slider 
                                        </p>
                                        <img src="{{asset('storage/slider/'.$d->image)}}" width="30%" alt="">
                                        <input type="file" name="slider">
                                        <button type="submit" class="btn btn-danger">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                                    <h5 class="modal-title" id="deleteUserModalLabel">Delete Slider</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete Slider {{ $d->name }}?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('admin.k-slider.delete', $d->id) }}" method="POST">
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
                <h5 class="modal-title" id="addUserModalLabel">Add Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.k-slider.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="slider" class="form-label">Slider</label>
                        <input type="file" class="form-control" name="slider" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
