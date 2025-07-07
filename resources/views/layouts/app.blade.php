<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }

        /* Header */
        .header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
        }

        .header .menu-toggle {
            font-size: 1.5rem;
            cursor: pointer;
            color: #fff;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: -250px;
            width: 250px;
            background: linear-gradient(to bottom right, #ffffff, #f1f3f5);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            transition: left 0.3s ease;
            z-index: 1020;
            padding-top: 80px;
            border-right: 1px solid #dee2e6;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar .profile-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem;
            margin: 0 1rem 1.5rem;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .sidebar .profile-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e9ecef;
        }

        .sidebar h6 {
            margin-top: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .sidebar small {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            color: #343a40;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            color: #6c757d;
            transition: color 0.2s;
        }

        .sidebar .nav-link:hover {
            background: #e9ecef;
            color: #212529;
        }

        .sidebar .nav-link:hover i {
            color: #0d6efd;
        }

        /* Main content */
        .main-content {
            margin-left: 0;
            padding: 100px 2rem 2rem;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 250px;
        }

        /* Responsive */
        @media (min-width: 768px) {
            .sidebar {
                left: 0;
            }

            .main-content {
                margin-left: 250px;
            }

            .header .menu-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
   <header class="header shadow-sm py-2 bg-dark">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        
        {{-- Sidebar Toggle --}}
        <div class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars fs-5 text-dark"></i>
        </div>

        {{-- Logo + Title --}}
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
            <h4 class="mb-0 text-light">Admin Client Management</h4>
        </div>
        
    </div>
</header>

    <div class="d-flex">
        @auth
            <!-- Sidebar -->
            <nav id="sidebar" class="sidebar">
                <div class="profile-card">
                    <img src="{{ auth()->user()->profile_image_url }}" alt="Profile" class="profile-img">
                    <h6>{{ auth()->user()->name }}</h6>
                    <small>{{ auth()->user()->user_type->label() }}</small>
                </div>

                <ul class="nav flex-column">
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.clients.index') }}">
                                <i class="fas fa-users"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.assigned-texts.index') }}">
                                <i class="fas fa-file-alt"></i> Assigned Texts
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show') }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-start">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @endauth

        <!-- Main Content -->
        <main id="main" class="main-content w-100">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('active');
            main.classList.toggle('shifted');
        }
    </script>

    @stack('scripts')
</body>
</html>
