@extends('layouts.front')
@section('title', 'Login / Register')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Login</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Login</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Login Register Section -->
    <section id="login-register" class="login-register section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-register-wraper">

                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs nav-tabs-bordered justify-content-center mb-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#login-register-login-form" type="button" role="tab"
                                    aria-selected="true">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#login-register-registration-form" type="button" role="tab"
                                    aria-selected="false">
                                    <i class="bi bi-person-plus me-1"></i>Register
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <!-- Login Form -->
                            <div class="tab-pane fade show active" id="login-register-login-form" role="tabpanel">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="login-register-login-email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="login-register-login-email"
                                            name="email" required="">
                                    </div>

                                    <div class="mb-4">
                                        <label for="login-register-login-password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            id="login-register-login-password" required="">
                                    </div>


                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Registration Form -->
                            <div class="tab-pane fade" id="login-register-registration-form" role="tabpanel">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <label for="login-register-reg-firstname" class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="login-register-reg-firstname" required="">
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <label class="form-label">No Telp</label>
                                                <input type="number" class="form-control" name="phone_number"
                                                    required="">
                                                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="login-register-reg-email" class="form-label">Email
                                                    address</label>
                                                <input type="email" class="form-control" name="email"
                                                    id="login-register-reg-email" required="">
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label for="login-register-reg-password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="login-register-reg-password" required="">
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-lg">Create
                                                    Account</button>
                                            </div>
                                        </div>
                                    </div>
                                    </formm>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
