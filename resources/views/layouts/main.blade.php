<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/mycss.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/myjs.js') }}"></script>
</head>

<body>
    <div class="page-header mb-3">
        <a href="{{ url('/') }}" class="header-title">FreelyNews</a>
    </div>
    <div class="container">
        @yield('content')
        {{-- fixed-bottom d-inline-flex justify-content-end align-items-end --}}
        <div class="menu-container">
            <div class="d-inline-flex justify-content-end align-items-end flex-column">
                <div class="menu-content menu-hide">
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Home</a>
                    </div>
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Berita</a>
                    </div>
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Teknologi</a>
                    </div>
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Bisnis</a>
                    </div>
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Showbiz</a>
                    </div>
                    <div class="my-4 mx-5">
                        <a href="#" class="menu">Lainnya</a>
                    </div>
                </div>
                <button class="menu-nav view-menu" value="view">
                    <div class="menu-icon-container">
                        <div class="menu-icon1"></div>
                        <div class="menu-icon2"></div>
                        <div class="menu-icon3"></div>
                    </div>
                </button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
