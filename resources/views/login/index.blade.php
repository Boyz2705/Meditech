@extends('layouts.auth')
@section('content')
    <section class="sample-page">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    @if (session()->has('success'))
                        <div class="row justify-content-center">
                            <div class="alert alert-success alert-dismissible text-center col-lg-11 fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div class="row justify-content-center">
                            <div class="alert alert-danger alert-dismissible text-center col-lg-11 fade show"
                                role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card card-5">
                        <div class="card-heading">
                            <h2 class="title">Login</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/login">
                                @csrf

                                <div class="form-row">
                                    <div class="name">User Name</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <input class="input--style-5 @error('username') is-invalid @enderror"
                                                id="username" name="username" type="text" placeholder="input username"
                                                autofocus required value="{{ old('username') }}">
                                        </div>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="name">Password</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <input class="input--style-5 @error('password') is-invalid @enderror"
                                                id="password" name="password" type="password"
                                                placeholder="input placeholder" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button class="btn btn--radius-2"
                                        style="background-color: #008374; color: white; padding: 12px 20px 12px 20px; font-family: sans-serif"
                                        type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
