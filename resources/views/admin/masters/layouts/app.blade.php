<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NGO Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ngo-red: #d93025;
            --ngo-green: #1a5928;
            --sidebar-width: 260px;
            --header-height: 60px;
            --dark-bg: #111;
        }

        body {
            background: #f8f9fa;
              font-family: 'Roboto Condensed', sans-serif !important;

            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            background: var(--dark-bg);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Jab sidebar toggle hoga (Laptop & Mobile dono ke liye) */
        #sidebar.collapsed {
            left: calc(-1 * var(--sidebar-width));
        }

        .sidebar-header {
            padding: 20px;
            background: #000;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #closeSidebar {
            cursor: pointer;
            font-size: 1.2rem;
            color: #fff;
            display: none;
            /* Default hidden */
        }

        .nav-link {
            color: #ccc;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            transition: 0.2s;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #222;
            color: #fff;
            border-left: 4px solid var(--ngo-red);
        }

        .nav-link i {
            width: 30px;
            font-size: 1.1rem;
        }

        /* Header Styling */
        #header {
            height: var(--header-height);
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 20px;
            transition: all 0.3s ease;
        }

        /* Jab sidebar collapse hoga to header poori width lega */
        #header.full-width {
            left: 0;
        }

        .toggle-btn {
            background: none !important;
            border: none !important;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;

            padding: 2px 10px;
        }

        /* Main Content Styling */
        #main-content {
            margin-left: var(--sidebar-width);
            padding: calc(var(--header-height) + 25px) 25px 25px;
            transition: all 0.3s ease;
        }

        /* Jab sidebar collapse hoga to content poori width lega */
        #main-content.full-width {
            margin-left: 0;
        }

        /* Overlay for Mobile */
        .overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-width));
            }

            #sidebar.active {
                left: 0;
            }

            #header {
                left: 0;
            }

            #main-content {
                margin-left: 0;
            }

            #closeSidebar {
                display: block;
            }

            /* Mobile par X dikhega */
            .overlay.active {
                display: block;
            }
        }


        .filter-card {

            background: #ffffff;
            border: 1px solid #eef0f3;
        }

        .filter-card .form-label {
            font-size: 13px;
            color: #555;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            border-radius: 8px;
            font-size: 14px;
        }

        .filter-card .btn {
            border-radius: 8px;
            font-size: 14px;
        }

        .table {
            font-size: 14px;
        }

        .table thead th {
            background-color: #f8f9fc;
            font-weight: 600;
            /* color: #4e73df; */
            text-transform: uppercase;
            font-size: 12px;
        }

        .table tbody tr:hover {
            background-color: #f9fafc;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 20px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            color: #4e73df;
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #e3e6f0;
            font-size: 14px;
        }

        .pagination .page-item.active .page-link {
            background-color: #4e73df;
            border-color: #4e73df;
            color: #fff;
        }

        .pagination .page-link:hover {
            background-color: #f1f3f8;
        }

        .record-info {
            font-size: 13px;
            color: #6c757d;
        }

        .export-btns .btn {
            border-radius: 8px;
            font-size: 13px;
            padding: 6px 14px;
        }


        .btn_submit{
            background-color: #4e73df;
            color: white;
        }

        .btn_submit:hover{
            background-color: #4e73df !important;
            color: white !important;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="overlay" id="overlay"></div>
    @include('admin.masters.layouts.includes.sidebar')
    @include('admin.masters.layouts.includes.header')
    <main id="main-content">
        @yield('content')
    </main>
    @include('admin.masters.layouts.includes.footer')
    @stack('scripts')
</body>

</html>
