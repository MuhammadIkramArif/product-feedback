@extends('layouts.app', ['title' => 'Login'])
@section('content')
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-8 col-11 d-flex justify-content-center">
                <div class="card bg-authentication mb-0">
                    <div class="row m-0">
                        <div style="border-right: 1px solid rgba(255, 255, 255, 0.2);" class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                            <img class="w-100" src="{{ asset('app-assets/images/pages/login.png') }}" alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0 pb-2">
                            <div class="card mb-0 px-2">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Login</h4>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-1">
                                        @include('alerts')
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <fieldset
                                                class="form-label-group form-group position-relative has-icon-left">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus required>
                                                <div class="form-control-position">
                                                    <i class="feather icon-user"></i>
                                                </div>
                                                <label for="email">Email Address</label>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group position-relative has-icon-left">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password">
                                                <div class="form-control-position">
                                                    <i class="feather icon-lock"></i>
                                                </div>
                                                <label for="password">Password</label>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <div class="form-group d-flex justify-content-between align-items-center">
                                                <div class="text-left">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="remember"
                                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span>Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <div class="text-right"><a href="{{ route('password.request') }}"
                                                                               class="card-link">Forgot Password?</a>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="text-left">
                                                <a href="{{ route('register') }}"
                                                   class="btn btn-outline-primary float-left btn-inline">Register</a>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary float-right btn-inline">Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
