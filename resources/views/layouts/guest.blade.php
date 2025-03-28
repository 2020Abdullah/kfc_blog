<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- meta code -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('meta_description', 'نعمل علي تحقيق الأمن الغذائي للثروة الحيوانية من خلال توفير الأعلاف لمربي الماشية بأسعار تنافسية ‘ وكذلك تحقيق الرعاية البيطرية للثروة الحيوانية الخاصة بمربي الماشية من خلال العيادات والصيدليات البيطرية')">
        <meta name="author" content="تعاونية الأصول">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="@yield('meta_title', 'تعاونية الأصول')">
        <meta property="og:image" content="{{ asset('assets/logo.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="تعاونية الأصول">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:title" content="@yield('meta_title', 'تعاونية الأصول')">
        <meta name="description" content="@yield('meta_description', 'نعمل علي تحقيق الأمن الغذائي للثروة الحيوانية من خلال توفير الأعلاف لمربي الماشية بأسعار تنافسية ‘ وكذلك تحقيق الرعاية البيطرية للثروة الحيوانية الخاصة بمربي الماشية من خلال العيادات والصيدليات البيطرية')">
        <meta property="og:image" content="{{ asset('assets/logo.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">        
        
        <!-- fontasome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('fronted/css/bootstrap.rtl.min.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        
        <!-- mystyle -->
        <link rel="stylesheet" href="{{ asset('fronted/css/style.css') }}" />

        @yield('css')

    </head>
    <body>
        <!-- header section -->
        <x-Header-section />

        <!-- content section -->
        <main id="main">
            @yield('content')
        </main>

        <!-- footer section -->
        <x-footer-section />
        
        <!-- All scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Owl Carousel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script src="{{ asset('fronted/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('fronted/js/scripts.js') }}"></script>
        @yield('script')
    </body>
</html>
