<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Payakumbuah Restoran - @yield('title')</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/assets') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/assets') }}/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar start -->
    @include('frontend.template.navbar')
    @include('frontend._modal-search')
    <!-- Navbar End -->

    {{-- Main Content --}}
    <main class="main">
        @yield('content')
    </main>
    {{-- Main End --}}

    <!-- Footer Start -->
    @include('frontend._footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/lightbox/js/lightbox.min.js"></script>
    <script src="{{ asset('frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/assets') }}/js/main.js"></script>
</body>

</html>
