@extends('layouts.admin.main')
@section('title')
Edit Profile || Admin
@endsection 
@section('pages')
Edit Profile    
@endsection
@section('content')
    <div class="card">
        <div class="container">

            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder mt-3">Edit Your Profile</h3>
                <p class="mb-4">
                This is your profile data. Make sure you save this properly.
                </p>
            </div>
            
            <form action="{{route('profile.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="row ms-3">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <p>Account Info</p>
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" style="outline: 2px solid gray;" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="password" name="password"   value="{{$user->role == 0 ? 'Admin' : 'Pembeli' }}" readonly >
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile" style="outline: 2px solid gray;"  name="profile">
                            <img src="{{ asset('storage/' . $user->profile) }}" alt="Current Profile Picture"  class="img-thumbnail mt-2" width="100">
                        </div>
            
                    </div>
                    
                    <div class="col-md-6">
                        <p>For your login</p>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" style="outline: 2px solid gray;"  value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" style="outline: 2px solid gray;"  value="{{ old('username', $user->username) }}" >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" style="outline: 2px solid gray;"   >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" id="password" name="password_confirmation" style="outline: 2px solid gray;"   >
                        </div>
                        
                    </div>
                    
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
