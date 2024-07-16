@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="register-card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class=register-card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        <!-- Name Field -->
                        <div class="row mb-3 input-group">
                            <label for="name" class="col-md-4 text-md-end">
                                <i class="fas fa-user input-icon"></i>
                            </label>

                            <div class="col-md-6 form">
                                <input id="name" type="text" class="form-control custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="row mb-3 input-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-envelope input-icon"></i>
                            </label>

                            <div class="col-md-6 form">
                                <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-3 input-group">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                <i class="fas fa-key input-icon"></i>
                            </label>

                            <div class="col-md-6 form">
                                <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
