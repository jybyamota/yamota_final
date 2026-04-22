<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --bg-secondary: #f8fafc;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-tertiary: #64748b;
            --border-light: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
        }

        .login-card {
            background: white;
            border-radius: 8px;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
            padding: 2.5rem;
        }

        .login-header {
            display: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-control {
            border: 1px solid var(--border-light);
            border-radius: 6px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            background-color: var(--primary);
            border: none;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .alert {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .invalid-feedback {
            display: block;
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .demo-info {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h1>EduManager</h1>
                <p>Education Management System</p>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <strong>Error:</strong> Invalid username or password. Please try again.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-control @error('username') is-invalid @enderror" 
                        value="{{ old('username') }}" 
                        placeholder="Enter your username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>

            <div class="demo-info">
                <strong>Demo Credentials</strong>
                <div class="demo-credentials">
                    <span><strong>Username:</strong> admin</span>
                    <span><strong>Password:</strong> admin123</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
