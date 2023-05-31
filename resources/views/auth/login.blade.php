@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="logo">
                            Volvagia
                        </h1>
                        {{ __('Login') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">

                                <div class="col">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="showPass()"><i class="fas fa-eye"></i></button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a href="{{ route('register') }}">No tengo cuenta aún</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showPass(){
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("button-addon1").innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                x.type = "password";
                document.getElementById("button-addon1").innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
    </script>
@endsection
