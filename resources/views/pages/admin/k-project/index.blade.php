@extends('layouts.admin.main')
@section('title', 'Kelola Project || Admin')
@section('pages', 'Kelola Project')

@section('content')
<div class="card">
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <h4>Kelola Project</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-plus-circle"></i> Add Project
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Sub Judul</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Video</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td class="align-middle">{{$loop->iteration}}</td>
                            <td class="align-middle">{{$d->judul}}</td>
                            <td class="align-middle">{{$d->sub_judul}}</td>
                            <td class="align-middle">{{$d->deskripsi}}</td>
                            <td class="align-middle">
                                <div id="carousel-{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (json_decode($d->foto) as $index => $foto)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto) }}" alt="Project Foto" style="width:100px; height:auto;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $d->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $d->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="carousel slide video-carousel" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        @foreach (json_decode($d->video) as $index => $video)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <video width="100" height="auto" controls onended="slideNext(this)">
                                                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const carousels = document.querySelectorAll('.video-carousel');
                                        
                                        carousels.forEach((carousel, index) => {
                                            // Generate a unique ID
                                            const uniqueId = `video-carousel-unique-${index}`;
                                            carousel.id = uniqueId;
                                
                                            // Update the controls to target the unique carousel ID
                                            const prevButton = carousel.querySelector('.carousel-control-prev');
                                            const nextButton = carousel.querySelector('.carousel-control-next');
                                            prevButton.setAttribute('data-bs-target', `#${uniqueId}`);
                                            nextButton.setAttribute('data-bs-target', `#${uniqueId}`);
                                
                                            // Initialize the carousel without auto-slide
                                            new bootstrap.Carousel(carousel, {
                                                interval: false
                                            });
                                
                                            // Add event listeners to maintain manual control
                                            prevButton.addEventListener('click', function () {
                                                const bsCarousel = bootstrap.Carousel.getInstance(carousel);
                                                bsCarousel.prev();
                                            });
                                
                                            nextButton.addEventListener('click', function () {
                                                const bsCarousel = bootstrap.Carousel.getInstance(carousel);
                                                bsCarousel.next();
                                            });
                                        });
                                    });
                                
                                    function slideNext(videoElement) {
                                        const carousel = videoElement.closest('.carousel');
                                        if (carousel) {
                                            const bootstrapCarousel = bootstrap.Carousel.getInstance(carousel);
                                            bootstrapCarousel.next(); // Move to the next slide after video ends
                                        }
                                    }
                                </script>
                                
                            </td>
                            
                            
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $d->id }}">
                                    Delete
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $d->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel-{{ $d->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteLabel-{{ $d->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this project?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.project.delete',$d->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding Project -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" style="outline: 2px solid grey;" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="sub_judul" class="form-label">Sub Judul</label>
                        <input type="text" class="form-control" style="outline: 2px solid grey;" id="sub_judul" name="sub_judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" style="outline: 2px solid grey;" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <div id="fotoContainer">
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="foto[]" accept="image/*" onchange="showUploadStatus(this, 'foto')">
                                <div class="spinner-container" style="display:none;">
                                    <div class="spinner"></div>
                                </div>
                                <div class="upload-status" style="display:none;">Uploading...</div>
                                <button type="button" class="btn btn-success btn-add-foto">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="video" class="form-label">Video</label>
                        <div id="videoContainer">
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="video[]" accept="video/*" onchange="showUploadStatus(this, 'video')">
                                <div class="spinner-container" style="display:none;">
                                    <div class="spinner"></div>
                                </div>
                                <div class="upload-status" style="display:none;">Uploading...</div>
                                <button type="button" class="btn btn-success btn-add-video">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include CKEditor Script -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize CKEditor for the Deskripsi field
     

        // Add new Foto input field
        document.querySelector('.btn-add-foto').addEventListener('click', function () {
            let container = document.getElementById('fotoContainer');
            let newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="file" class="form-control" name="foto[]" accept="image/*" onchange="showUploadStatus(this, 'foto')">
                <div class="spinner-container" style="display:none;">
                    <div class="spinner"></div>
                </div>
                <div class="upload-status" style="display:none;">Uploading...</div>
                <button type="button" class="btn btn-danger btn-remove">-</button>
            `;
            container.appendChild(newInput);

            // Add remove button functionality
            newInput.querySelector('.btn-remove').addEventListener('click', function () {
                newInput.remove();
            });
        });

        // Add new Video input field
        document.querySelector('.btn-add-video').addEventListener('click', function () {
            let container = document.getElementById('videoContainer');
            let newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="file" class="form-control" name="video[]" accept="video/*" onchange="showUploadStatus(this, 'video')">
                <div class="spinner-container" style="display:none;">
                    <div class="spinner"></div>
                </div>
                <div class="upload-status" style="display:none;">Uploading...</div>
                <button type="button" class="btn btn-danger btn-remove">-</button>
            `;
            container.appendChild(newInput);

            // Add remove button functionality
            newInput.querySelector('.btn-remove').addEventListener('click', function () {
                newInput.remove();
            });
        });
    });

    // Function to show the upload status and spinner when a file is selected
    function showUploadStatus(input, type) {
        const spinnerContainer = input.parentElement.querySelector('.spinner-container');
        const uploadStatus = input.parentElement.querySelector('.upload-status');

        // Show spinner and upload status
        spinnerContainer.style.display = 'inline-block';
        uploadStatus.style.display = 'inline-block';

        // Simulate upload completion (remove spinner after 2 seconds)
        setTimeout(function() {
            spinnerContainer.style.display = 'none';
            uploadStatus.textContent = 'Upload Complete';
            uploadStatus.style.color = 'green';

            // Optionally, hide the message after a few seconds
            setTimeout(function() {
                uploadStatus.style.display = 'none';
            }, 2000);
        }, 2000);
    }
</script>

@endsection
