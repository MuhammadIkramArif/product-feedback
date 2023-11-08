@extends('layouts.app', ['title' => 'Register'])
@section('content')
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-8 col-11 d-flex justify-content-center">
                <div class="card bg-authentication rounded-0 mb-0">
                    <div class="row m-0">
                        <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                            <img class="w-100" src="{{ asset('app-assets/images/pages/login.png') }}"
                                 alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="card rounded-0 mb-0 px-2">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Register</h4>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-1">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <fieldset
                                                class="form-label-group form-group position-relative has-icon-left">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                <div class="form-control-position">
                                                    <i class="feather icon-user"></i>
                                                </div>
                                                <label for="name">Name</label>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset
                                                class="form-label-group form-group position-relative has-icon-left">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                <div class="form-control-position">
                                                    <i class="feather icon-mail"></i>
                                                </div>
                                                <label for="email">Email Address</label>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group position-relative has-icon-left">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                                            <fieldset class="form-label-group position-relative has-icon-left">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                <div class="form-control-position">
                                                    <i class="feather icon-lock"></i>
                                                </div>
                                                <label for="password">Confirm Password</label>
                                            </fieldset>
                                            <a href="{{ route('login') }}"
                                               class="btn btn-outline-primary float-left btn-inline">Login</a>
                                            <button type="submit" class="btn btn-primary float-right btn-inline">Register
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="login-footer">
                                    <div class="divider">
                                        <div class="divider-text"></div>
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
