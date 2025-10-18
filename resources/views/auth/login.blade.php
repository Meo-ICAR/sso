@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2>Accedi</h2>
                        <p class="text-muted">Seleziona un metodo di accesso</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Traditional Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Accedi</button>
                        </div>
                    </form>

                    <div class="text-center mb-3">
                        <span class="text-muted">OPPURE</span>
                    </div>

                    <!-- Azure AD Login Button -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('login.azure') }}" class="btn" style="background-color: #00A4EF; color: white;">
                            <i class="fab fa-microsoft me-2"></i> Accedi con Microsoft
                        </a>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Password dimenticata?
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
