@extends('layouts.template')

@section('content')
<h1 class="mb-4 fw-bold">Detail Movie</h1>
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('storage/'.$movie->cover_image) }}"
                    class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                    style="max-height: 100%; object-fit: cover;"
                    alt="...">

                {{-- <img src="{{ asset('storage/'.$movie->cover_image) }}"
                     class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                     style="max-height: 100%; object-fit: cover;"
                     alt="{{ $movie->title }}"> --}}

              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title mb-4 fs-4 fw-bold">{{ $movie->title }}</h5>
                    <p class="card-text fs-6">Synopsis: <br>{{$movie->synopsis}}</p>
                    <p class="card-text fs-6">Year : {{ $movie->year }}</p>
                    <p class="card-text fs-6">Category: {{$movie->category->category_name}}</p>
                    <p class="card-text fs-6 mb-5">Actors : {{ $movie->actors }}</p>
                  <a href="/" class="btn btn-success fs-5 fw-bold"> ← Back </a>

                </div>
              </div>
            </div>
          </div>
        </div>



@endsection
