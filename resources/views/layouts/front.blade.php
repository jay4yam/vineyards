@props(['seoData'])
<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WQKXN23N');</script>
        <!-- End Google Tag Manager -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! seo($seoData) !!}

        <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
        <link rel='stylesheet' href='/css/animation.css' type='text/css' media='all' />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- css -->
        @vite(['resources/css/app.css'])

        <!-- dedicated css -->
        @yield('dedicated_css')
    </head>
    <body class="font-sans antialiased">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WQKXN23N" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
        <!-- nav -->
        @include('partials._nav')

        <!-- content -->
        <main>
            {{ $slot }}
        </main>

        <!-- footer -->
        @include('partials._footer')

        <!-- js -->
        @vite(['resources/js/app.js'])
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65d4b3b41eabb90019a548ed&product=inline-share-buttons' async='async'></script>
        @yield('dedicated_js')
    </body>
</html>
