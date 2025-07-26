<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library Management System')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1050;
            position: sticky;
            top: 0;
        }

        .sidebar {
            background: white;
            min-height: calc(100vh - 76px);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            border-radius: 0 15px 15px 0;
            transition: left 0.3s ease;
        }

        .sidebar .nav-link {
            color: var(--primary-color);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            transform: translateX(5px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .stats-card.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .book-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .badge {
            border-radius: 20px;
            padding: 8px 15px;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .page-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 30px;
        }

        .content-wrapper {
            padding: 30px;
            background: white;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 56px;
                left: -250px;
                width: 250px;
                z-index: 1040;
            }

            .sidebar.show {
                left: 0;
            }

            .content-wrapper {
                margin: 10px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-book-open me-2"></i>
                Library System
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-flex align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text">{{ auth()->user()->email }}</span></li>
                        <li><span class="dropdown-item-text"><small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                <i class="fas fa-book me-2"></i> Buku
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="fas fa-tags me-2"></i> Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('borrowings.admin') ? 'active' : '' }}" href="{{ route('borrowings.admin') }}">
                                <i class="fas fa-list-alt me-2"></i> Semua Peminjaman
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('borrowings.index') ? 'active' : '' }}" href="{{ route('borrowings.index') }}">
                                <i class="fas fa-history me-2"></i>
                                {{ auth()->user()->isAdmin() ? 'Riwayat Peminjaman' : 'Peminjaman Saya' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);

        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.querySelector('.navbar-toggler');
            const sidebar = document.querySelector('.sidebar');
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>