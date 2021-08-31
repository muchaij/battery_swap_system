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
            <div class="col-md-12 w-100 p-4">
                <form method="POST" action="{{ route('register') }}" class='row pt-4 pb-4'>
                    @csrf
                    <div class='col-sm-12 pb-2'>
                        <h4>Create New Account</h4>
                        <hr style='background-color: rgba(255,255,255,.7);'>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type='hidden' name='role' value='0'>
                        <label for="name">{{ __('First Name') }}</label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname"
                        autofocus placeholder="First Name">
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="name">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                        autofocus placeholder="First Name">
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Email Address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                        placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>

                    <div class="form-group col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create Account') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
