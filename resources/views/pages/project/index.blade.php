@extends('layouts.main')

@section('title')
PT. Trisurya Solusindo Utama || Project
@endsection

@section('content')
<div class="container px-5 pb-5">
    <h1 class="fw-bold text-center mb-4" style="font-size: 32px; color: #28a745;">
        <i class="fas fa-project-diagram"></i> Our Projects
    </h1>
    <div class="row gy-4">
        @foreach ($data as $project)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <!-- Image Slider -->
                        <div id="project-carousel-{{ $project->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach (json_decode($project->foto) as $index => $foto)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100 rounded" alt="Project Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#project-carousel-{{ $project->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#project-carousel-{{ $project->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Project Info -->
                        <h5 class="fw-bold text-success mt-3">{{ $project->judul }}</h5>
                        <p class="text-muted">{{ $project->sub_judul }}</p>
                        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#projectModal-{{ $project->id }}">
                            View Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal for Project Details -->
            <div class="modal fade" id="projectModal-{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel-{{ $project->id }}" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="projectModalLabel-{{ $project->id }}">{{ $project->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Project Images -->
                            <h5 class="text-primary mb-3">Project Images</h5>
                            <div class="row mb-4">
                                <div id="project-carousel-modal-{{ $project->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (json_decode($project->foto) as $index => $foto)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $foto) }}" class="d-block w-100 rounded" alt="Project Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#project-carousel-modal-{{ $project->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#project-carousel-modal-{{ $project->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            

                            <!-- Project Subtitle and Description -->
                            <h6 class="text-success">{{ $project->sub_judul }}</h6>
                            <p>{{ $project->deskripsi }}</p>

                            <!-- Project Videos -->
                            <h5 class="mt-4 text-primary">Project Videos</h5>
                            <div class="row">
                                @foreach (json_decode($project->video) as $video)
                                    <div class="col-6 col-md-4 mb-3">
                                        <video class="d-block w-100 rounded shadow-sm" controls style="max-height: 250px;">
                                            <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Custom CSS -->
<style>
.carousel-inner img {
    height: 200px;
    object-fit: cover;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.modal-body {
    overflow-y: auto;
    max-height: calc(100vh - 200px);
}

.modal-body img {
    max-height: 500px;
    object-fit: cover;
}

.modal-body h5 {
    font-size: 24px;
    font-weight: bold;
    color: #007bff;
}

.modal-body p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

.modal-footer {
    border-top: none;
}

.video-thumbnail {
    width: 100%;
    height: auto;
}

.row .col-md-4 {
    margin-bottom: 20px;
}

.carousel-control-prev-icon, .carousel-control-next-icon {
    filter: invert(100%);
}
</style>
@endsection
