
@extends('layouts.main')
@section('title','Daftar Kategori')
@section('navCategory','active')
@section('content')

<h1 class="mb-4">Daftar Kategori Film</h1>
<a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Data Kategori</a>

@if(request('search'))
    <div class="mb-3">
        <span class="text-muted">Hasil pencarian untuk: <strong>{{ request('search') }}</strong></span>
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Dibuat Pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($categories as $category)
        <tr>
            <td>{{ $categories->firstItem() + $loop->index }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data kategori.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $categories->links() }}

@endsection
