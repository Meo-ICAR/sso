<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .btn-microsoft {
            background-color: #00A4EF;
            color: white;
        }
        .btn-microsoft:hover {
            background-color: #0086D6;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <h2>Accedi</h2>
            <p class="text-muted">Seleziona un metodo di accesso</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-grid gap-2">
            <a href="{{ route('login.azure') }}" class="btn btn-microsoft btn-lg">
                <i class="fab fa-microsoft me-2"></i> Accedi con Microsoft
            </a>
        </div>

        @if (Route::has('login'))
            <div class="mt-3 text-center">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    {{ __('Torna al login standard') }}
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
