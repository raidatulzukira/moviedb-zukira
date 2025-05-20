@extends('layouts.main')

@section('title','Edit Movie')
@section('navMovie','active')

@section('content')
<div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12">
            <h1 class="h2">Edit Data Movie</h1>

            <form action="{{ route('movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul Movie --}}
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Judul Movie</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $movie->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="row mb-3">
                    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Sinopsis --}}
                <div class="row mb-3">
                    <label for="synopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <textarea name="synopsis" class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" rows="6">{{ old('synopsis', $movie->synopsis) }}</textarea>
                        @error('synopsis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tahun --}}
                <div class="row mb-3">
                    <label for="year" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" id="year" value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') }}">
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Aktor --}}
                <div class="row mb-3">
                    <label for="actors" class="col-sm-2 col-form-label">Pemain</label>
                    <div class="col-sm-10">
                        <textarea name="actors" class="form-control @error('actors') is-invalid @enderror" id="actors" rows="3">{{ old('actors', $movie->actors) }}</textarea>
                        @error('actors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Cover Image --}}
                <div class="row mb-3">
                    <label for="cover_image" class="col-sm-2 col-form-label">Cover Image</label>
                    <div class="col-sm-10">
                        @if($movie->cover_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/covers/' . $movie->cover_image) }}" alt="{{ $movie->title }}" width="120" class="img-thumbnail">
                            </div>
                        @endif
                        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" accept="image/*">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti cover.</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
