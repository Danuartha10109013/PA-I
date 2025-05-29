@extends('layouts.admin.main')
@section('title', 'Kelola About || Admin')
@section('pages', 'Kelola About')

@section('content')
<div class="card">
    <div class="container mt-3">
        <!-- Top Section with Save Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Kelola About</h4>
            <button type="submit" form="aboutForm" class="btn btn-primary"><i class="fa-solid fa-save"></i> SAVE</button>
        </div>

        <!-- Form Start -->
        <form id="aboutForm" action="{{ route('admin.about.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-3">
                <label for="judul" class="form-label fw-bolder" style="color: black">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $data->judul) }}" required>
            </div>

            <!-- Deskripsi Judul -->
            <div class="mb-3">
                <label for="desc_judul" class="form-label fw-bolder" style="color: black">Deskripsi Judul</label>
                <input type="text" name="desc_judul" id="desc_judul" class="form-control" value="{{ old('desc_judul', $data->desc_judul) }}" required>
            </div>

            <!-- JSON Inputs -->
            @foreach (['item' => 'Item', 'desc_item' => 'Deskripsi Item'] as $jsonField => $label)
                <div class="mb-3">
                    <label for="{{ $jsonField }}" class="form-label fw-bolder" style="color: black">{{ $label }}</label>
                    <div id="{{ $jsonField }}-container">
                        @if (!empty($data->$jsonField))
                            @foreach (json_decode($data->$jsonField) as $key => $value)
                                <div class="input-group mb-2">
                                    <input type="text" name="{{ $jsonField }}[]" class="form-control" value="{{ old("$jsonField.$key", $value) }}" required>
                                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" name="{{ $jsonField }}[]" class="form-control" placeholder="Enter {{ $label }}" required>
                                <button type="button" class="btn btn-danger btn-remove">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-success btn-add" data-target="{{ $jsonField }}-container">Add {{ $label }}</button>
                </div>
            @endforeach

            <!-- Visi -->
            <div class="mb-3">
                <label for="visi" class="form-label fw-bolder" style="color: black">Visi</label>
                <input type="text" name="visi" id="visi" class="form-control" value="{{ old('visi', $data->visi) }}" required>
            </div>

            <!-- Misi Tagline-->
            <div class="mb-3">
                <label for="misi_tagline-container" class="form-label fw-bolder" style="color: black">Misi Tagline</label>
                <div id="misi_tagline-container">
                    @if (!empty($data->misi_tagline))
                        @foreach (json_decode($data->misi_tagline) as $key => $value)
                            <div class="input-group mb-2">
                                <input type="text" name="misi_tagline[]" class="form-control" value="{{ old("misi_tagline.$key", $value) }}" required>
                                <button type="button" class="btn btn-danger btn-remove">Remove</button>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2">
                            <input type="text" name="misi_tagline[]" class="form-control" placeholder="Enter Misi_tagline" required>
                            <button type="button" class="btn btn-danger btn-remove">Remove</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-success btn-add" data-target="misi_tagline-container">Add Misi Tagline</button>
            </div>
            <!-- Misi -->
            <div class="mb-3">
                <label for="misi-container" class="form-label fw-bolder" style="color: black">Misi</label>
                <div id="misi-container">
                    @if (!empty($data->misi))
                        @foreach (json_decode($data->misi) as $key => $value)
                            <div class="input-group mb-2">
                                <input type="text" name="misi[]" class="form-control" value="{{ old("misi.$key", $value) }}" required>
                                <button type="button" class="btn btn-danger btn-remove">Remove</button>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2">
                            <input type="text" name="misi[]" class="form-control" placeholder="Enter Misi" required>
                            <button type="button" class="btn btn-danger btn-remove">Remove</button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-success btn-add" data-target="misi-container">Add Misi</button>
            </div>

            <!-- Link Map -->
            <div class="mb-3">
                <label for="link_map" class="form-label fw-bolder" style="color: black">Link Map</label>
                <input type="text" name="link_map" id="link_map" class="form-control" value="{{ old('link_map', $data->link_map) }}" required>
            </div>

            <!-- Hotline -->
            <div class="mb-3">
                <label for="hotline" class="form-label fw-bolder" style="color: black">Hotline</label>
                <input type="text" name="hotline" id="hotline" class="form-control" value="{{ old('hotline', $data->hotline) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-bolder" style="color: black">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $data->email) }}" required>
            </div>

            

            
        </form>
    </div>
</div>

<!-- JavaScript for Dynamic Input -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add new input
        document.querySelectorAll('.btn-add').forEach(button => {
            button.addEventListener('click', function () {
                const target = document.getElementById(this.getAttribute('data-target'));
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-2');
                newInputGroup.innerHTML = `
                    <input type="text" name="${target.id.replace('-container', '')}[]" class="form-control" placeholder="Enter ${target.id.replace('-container', '')}" required>
                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                `;
                target.appendChild(newInputGroup);

                // Add remove functionality
                newInputGroup.querySelector('.btn-remove').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });
        });

        // Remove input
        document.querySelectorAll('.btn-remove').forEach(button => {
            button.addEventListener('click', function () {
                this.parentElement.remove();
            });
        });
    });
</script>
@endsection
