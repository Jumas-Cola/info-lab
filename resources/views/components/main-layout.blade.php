<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="{{ $description ?? $title ?? config('app.name', 'Laravel') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="120x120" href="/favicon-120x120.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.scss'])

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

    <div class="page-main-content">
        {{ $slot }}
    </div>

    <x-nav.scroll-top-btn />

    <x-nav.ai-chat-btn />

    <x-nav.use-cookie />

    <x-nav.footer />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

</body>

</html>
