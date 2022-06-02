<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS --}}
    @include('layouts.css')

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            {{-- <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a> --}}
                            <a href="">
                                <h4>Toko Online Buton</h4>
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR --}}
                @include('layouts.sidebar')

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ date('Y') }} &copy; toko online buton</p>
                    </div>
                    <div class="float-end">
                        <p>Dibuat <span class="text-danger"></i></span> oleh <a
                                href="http://ahmadsaugi.com">Mahasiswa UIM</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{-- JS --}}
    @include('layouts.js')
</body>

</html>
