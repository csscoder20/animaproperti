<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', '-') | Anima Property</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    {{-- Style di sini --}}
    @include('frontend.layouts.style')
</head>

<body class="index-page">

    @include('frontend.layouts.header')
    {{-- Header di sini --}}

    <main class="main">
        {{-- Section di sini --}}
        @yield('content')
    </main>


    @include('frontend.layouts.footer')


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>


    @include('frontend.layouts.script')

</body>

</html>
