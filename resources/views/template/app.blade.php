<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- $title diambil dari extends ['title' => '...'] --}}
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- icon bar --}}
    {{-- asset() : memanggil file yang ada di folder public --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/logo2.png') }}">

    {{-- stack : wadah penampung content dinamis namun optional (tidak selalu digunakan) biasanya untuk wadah styling tambahan atau script tambahan --}}
    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CAFE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }}"
                            href="{{ route('landing_page') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }} " aria-current="page"
                            href="/home">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('user') ? 'active' : '' }}"
                            href="{{ route('user') }}">Account</a>
                    </li>
                </ul>

                @if (Route::is('home'))
                    <form class="d-flex" role="search" action="{{ route('home') }}" method="GET">
                    @else
                        <form class="d-flex" role="search" action="{{ route('user') }}" method="GET">
                @endif
                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search"
                    autocomplete="off">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- wadah untuk penampung content yang berbeda ditiap halamannya --}}
    @yield('content-dinamis')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('script')
</body>

</html>
