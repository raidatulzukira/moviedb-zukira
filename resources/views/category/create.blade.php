@extends('layouts.main')
@section('title','Tambah Data Kategori')
@section('content')
<div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12">
            <h1 class="mb-5">Tambah Data Kategori Film</h1>

            <form action="{{ route('category.store') }}" method="post">
                @csrf

                {{-- Field ID (readonly & auto-generated) --}}
                <div class="row mb-3">
                    <label for="id" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control bg-light text-muted" id="id" value="{{ $nextId }}" readonly>
                    </div>
                </div>

                {{-- Field category_name --}}
                <div class="mb-3 row">
                    <label for="category_name" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text"
                               name="category_name"
                               class="form-control @error('category_name') is-invalid @enderror"
                               id="category_name"
                               value="{{ old('category_name') }}"
                               placeholder="Masukkan nama kategori">
                        @error('category_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Field description --}}
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
