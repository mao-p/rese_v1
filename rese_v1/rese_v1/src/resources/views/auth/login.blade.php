@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="card login-card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label d-flex align-items-center">
                        <i class="fas fa-envelope me-2"></i>
                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    </label>
                    @error('email')
                        <span class="custom-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label d-flex align-items-center">
                        <i class="fas fa-key me-2"></i>
                        <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                    </label>
                    @error('password')
                        <span class="custom-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('ログイン') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
