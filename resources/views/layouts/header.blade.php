
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark py-2">
        <div class="container-fluid">
            <a class="navbar-brand fs-4" href="/">Bioskop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('navHome')"  href="">Home</a>
                        {{-- <a class="nav-link" href="{{ route('home') }}">Home</a> --}}

                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('navCategory')"  href="{{ route('category.index') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('navMovie')" href="{{'movie' }}">Movie</a>
                    </li>

                </ul>


                <form class="d-flex" role="search"
                    action="{{ request()->is('movie*') ? route('movie.index') : route('category.index') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-success me-2" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ request()->is('movie*') ? route('movie.index') : route('category.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>



            </div>
        </div>
    </nav>
</header>
