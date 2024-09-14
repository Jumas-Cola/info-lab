<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="{{ $description ?? config('app.name', 'Laravel') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.scss'])

    <!-- Additional CSS Files -->
    <!-- <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" /> -->
    <!--

TemplateMo 586 Scholar

https://templatemo.com/tm-586-scholar

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <!-- <div id="js-preloader" class="js-preloader"> -->
    <!--     <div class="preloader-inner"> -->
    <!--         <span class="dot"></span> -->
    <!--         <div class="dots"> -->
    <!--             <span></span> -->
    <!--             <span></span> -->
    <!--             <span></span> -->
    <!--         </div> -->
    <!--     </div> -->
    <!-- </div> -->
    <!-- ***** Preloader End ***** -->

    <x-nav.header />

    {{ $slot }}

    <x-nav.scroll-top-btn />

    <x-nav.footer />

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="assets/js/isotope.min.js"></script> -->
    <!-- <script src="assets/js/owl-carousel.js"></script> -->
    <!-- <script src="assets/js/counter.js"></script> -->
    <!-- <script src="assets/js/custom.js"></script> -->
    @vite(['resources/js/app.js'])

</body>

</html>
