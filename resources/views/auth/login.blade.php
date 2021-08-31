@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center register mybg">
        <div class='d-none d-md-block col-md-6 text-center text-white'>
            <h5>Dont have an Account?</h5>
            <p>Create a new account here</p>
            <a href='{{url('register')}}' class='btn btn-outline-white'>Create a New Account <i class='fas fa-arrow-right'></i></a>
        </div>
        <div class='col-md-6 bg-white d-flex align-items-center justify-content-center' style='min-height: 100vh;'>
            <div class="col-md-9 w-100 p-4">
                <form method="POST" action="{{ route('login') }}">
                    <h4>Sign In</h4>
                    <hr>
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                         placeholder="Email Address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" 
                        placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
