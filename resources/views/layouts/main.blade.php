<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Daftar Film di Bioskop')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        main>.container {
            padding: 90px 10px 10px;
        }
    </style>

</head>

<body class="d-flex flex-column h-100">

    @include('layouts.header')

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            @yield('content')
            @yield('container')

        </div>
    </main>

    @include('layouts.footer')

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

    </script>



</body>

</html>


