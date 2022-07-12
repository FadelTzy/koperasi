<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('v/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('v/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('v/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('v/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('v/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('v/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('v/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('v/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('v/assets/css/icons.css') }}" rel="stylesheet">

    @yield('css')
    <title>Koperasi - SMPN 1 PALANGGA</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <x-asidebar></x-asidebar>
        <!--end sidebar wrapper -->
        <!--start header -->
        <x-aheader></x-aheader>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <x-afooter></x-afooter>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('v/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('v/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('v/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('v/assets/js/app.js') }}"></script>

    @stack('js')
</body>


<!-- Mirrored from codervent.com/rukada/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Apr 2022 06:44:50 GMT -->

</html>
