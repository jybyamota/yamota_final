<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'EduManager') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #60a5fa;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #0ea5e9;
            
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-tertiary: #64748b;
            
            --border-light: #e2e8f0;
            --border-regular: #cbd5e1;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.95rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .navbar {
            background-color: var(--bg-primary);
            border-bottom: 1px solid var(--border-light);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--primary-dark) !important;
        }

        .navbar-nav .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 0.875rem !important;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            background-color: var(--bg-secondary);
            border-radius: 4px;
        }

        .user-menu {
            border-left: 1px solid var(--border-light);
            padding-left: 1.25rem;
            margin-left: 1.25rem;
        }

        .main-content {
            padding: 2.5rem 0;
        }

        .page-header {
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--border-light);
            padding-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--text-tertiary);
            font-size: 0.9rem;
            margin: 0;
        }

        .card {
            border: none;
            border-radius: 8px;
            background-color: var(--bg-primary);
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-light);
            font-weight: 600;
            color: var(--text-primary);
            padding: 1.25rem;
            font-size: 0.95rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table {
            color: var(--text-primary);
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--bg-secondary);
            border-bottom: 2px solid var(--border-light);
            font-weight: 600;
            color: var(--text-primary);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border-top: none;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 1rem;
            border-color: var(--border-light);
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: var(--bg-secondary);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-light);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .btn {
            font-weight: 500;
            border-radius: 6px;
            padding: 0.625rem 1.25rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #1d3a8a 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-outline-secondary {
            color: var(--text-secondary);
            border: 2px solid var(--border-light);
            background-color: transparent;
        }

        .btn-outline-secondary:hover {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            border-color: var(--border-regular);
        }

        .btn-outline-primary {
            color: var(--primary);
            border: 2px solid var(--primary);
            background-color: transparent;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-outline-danger {
            color: var(--danger);
            border: 2px solid var(--danger);
            background-color: transparent;
        }

        .btn-outline-danger:hover {
            background-color: var(--danger);
            color: white;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
        }

        .alert {
            border: none;
            border-left: 4px solid;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background-color: #ecfdf5;
            border-left-color: var(--success);
            color: #065f46;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-left-color: var(--danger);
            color: #7f1d1d;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-left-color: var(--warning);
            color: #78350f;
        }

        .alert-info {
            background-color: #ecf9ff;
            border-left-color: var(--info);
            color: #082f49;
        }

        .badge {
            padding: 0.4rem 0.75rem;
            font-weight: 600;
            font-size: 0.8rem;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.bg-light {
            background-color: var(--bg-secondary) !important;
            color: var(--text-primary);
            border: 1px solid var(--border-light);
        }

        .dropdown-menu {
            border: 1px solid var(--border-light);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            background-color: var(--bg-primary);
            padding: 0.5rem 0;
        }

        .dropdown-item:hover {
            background-color: var(--bg-secondary);
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-tertiary);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--border-regular);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .empty-state a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .empty-state a:hover {
            color: var(--primary-dark);
        }

        /* Status Indicators */
        .status-active {
            color: var(--success);
            font-weight: 600;
        }

        .status-inactive {
            color: var(--danger);
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 1.5rem 0;
            }

            .card {
                margin-bottom: 1.5rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th, .table tbody td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}" title="Home"><i class="fas fa-home"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">Subjects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('programs*') ? 'active' : '' }}" href="{{ route('programs.index') }}">Programs</a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown user-menu">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.change-password') }}">Change Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit" style="cursor: pointer;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid main-content">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
