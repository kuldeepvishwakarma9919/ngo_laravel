<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NGO Website')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('styles')


    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif !important;
        }
        

        html,
        body {
            max-width: 100%;
            overflow-x: hidden !important;
        }

        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: -50px;
        }
    </style>
</head>

<body>
    @include('home.masters.layouts.includes.header')
    @yield('content')
    @include('home.masters.layouts.includes.footer')
    <div class="sticky-donate"><a href="{{ route('home.donates') }}"><i class="fa fa-heart me-2"></i> DONATE NOW</a>
    </div>
    <a href="https://wa.me/919517048512" class="wa-float text-white text-decoration-none shadow-lg"><i
            class="fab fa-whatsapp"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @stack('scripts')
</body>

</html>
