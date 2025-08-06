<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', '-') | {{ $settings['site_name'] ?? 'Animaproperty' }}</title>
    <meta name="description"
        content="{{ $settings['site_description'] ?? 'Temukan berbagai pilihan properti terbaik mulai dari rumah, tanah, ruko, hingga apartemen. Beli, jual, atau sewa properti dengan mudah dan aman bersama' }}">
    <meta name="keywords" content="{{ $settings['keywords'] ?? 'properti, jual beli, rumah, tanah' }}">
    @php
        $favicon = $settings['favicon'] ?? null;
        $faviconUrl = $favicon ? asset('storage/' . $favicon) : asset('themes/frontend/assets/img/favicon.ico');

        $appleTouch = $settings['logo'] ?? null;
        $appleTouchUrl = $appleTouch
            ? asset('storage/' . $appleTouch)
            : asset('themes/frontend/assets/img/apple-touch-icon.png');
    @endphp

    <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ $appleTouchUrl }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    @include('frontend.layouts.style')
</head>

<body class="index-page">
    @include('frontend.layouts.header')
    <main class="main">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    @include('frontend.layouts.script')

</body>

</html>
