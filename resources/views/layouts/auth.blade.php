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
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }

        .auth-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .auth-header h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .auth-body {
            padding: 40px 30px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
        }

        .form-floating label {
            color: #6c757d;
        }

        .auth-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-link:hover {
            color: #2c3e50;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
