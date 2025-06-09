@extends('layouts.template')

@section('content')
<h1 class="mb-4 fw-bold">Update Data Movie</h1>
<div class="col-lg-12">

    <a href="/data-movie" class="btn btn-success mb-4">Kembali ke Data Movie</a>

    <form action="/update-movie/{{ $movie->id }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Judul Movie</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       id="title" value="{{ old('title', $movie->title) }}">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="synopsis" class="col-sm-2 col-form-label">Sinopsis</label>
            <div class="col-sm-10">
                <textarea name="synopsis" class="form-control @error('synopsis') is-invalid @enderror"
                          id="synopsis" rows="6">{{ old('synopsis', $movie->synopsis) }}</textarea>
                @error('synopsis')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="year" class="col-sm-2 col-form-label">Tahun</label>
            <div class="col-sm-10">
                <input type="number" name="year" class="form-control @error('year') is-invalid @enderror"
                       id="year" value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') }}">
                @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="actors" class="col-sm-2 col-form-label">Aktor</label>
            <div class="col-sm-10">
                <input type="text" name="actors" class="form-control @error('actors') is-invalid @enderror"
                       id="actors" value="{{ old('actors', $movie->actors) }}">
                @error('actors')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-4">
            <label for="cover_image" class="col-sm-2 col-form-label">Cover Image (Kosongkan jika tidak ingin ganti)</label>
            <div class="col-sm-10">
                <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
                       id="cover_image" accept="image/*">
                @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                @if ($movie->cover_image)
                    <small class="d-block mt-2">Gambar saat ini:</small>
                    <img src="{{ asset('storage/' . $movie->cover_image) }}" width="150" class="img-thumbnail mt-1">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="offset-sm-2 col-sm-10 mb-4">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection
