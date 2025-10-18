@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">{{ __('Profile Information') }}</h5>
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary">
                                {{ __('Edit Profile') }}
                            </a>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted mb-1">{{ __('Name') }}</label>
                            <p class="mb-0">{{ $user->name }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted mb-1">{{ __('Email') }}</label>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        
                        @if($user->microsoft_id)
                        <div class="mb-3">
                            <label class="form-label text-muted mb-1">{{ __('Microsoft Account') }}</label>
                            <p class="mb-0">
                                <span class="badge bg-primary">
                                    <i class="fab fa-microsoft me-1"></i> {{ __('Connected') }}
                                </span>
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <h5 class="mb-3">{{ __('Update Password') }}</h5>
                        <p class="text-muted">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                        <a href="{{ route('password.edit') }}" class="btn btn-outline-secondary">
                            {{ __('Update Password') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
