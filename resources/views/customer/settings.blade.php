@extends('layouts.front')
@section('title', 'Settings')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Settings</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    <li class="current">Settings</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="settings" class="account section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu d-lg-none mb-4">
                <button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu">
                    <i class="bi bi-grid"></i>
                    <span>Menu</span>
                </button>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                @include('customer.sidebar')

                <!-- Content Area -->
                <div class="col-lg-9">
                    <div class="row">
                        <!-- Account Information Card -->
                        <div class="col-12 mb-4" data-aos="fade-up">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="mb-0"><i class="bi bi-person-badge me-2 text-primary"></i>Informasi Akun</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted small">Nama</label>
                                            <p class="fw-bold">{{ auth()->user()->name }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted small">Email</label>
                                            <p class="fw-bold">{{ auth()->user()->email }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted small">Role</label>
                                            <p class="fw-bold"><span class="badge bg-success">{{ ucfirst(auth()->user()->role) }}</span></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted small">Member Sejak</label>
                                            <p class="fw-bold">{{ auth()->user()->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Card -->
                        <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom py-3">
                                    <h5 class="mb-0"><i class="bi bi-shield-lock me-2 text-warning"></i>Ganti Password</h5>
                                    <p class="text-muted small mb-0">Pastikan menggunakan password yang kuat untuk keamanan akun Anda</p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('customer.password.update') }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label fw-bold">
                                                <i class="bi bi-key me-1"></i> Password Saat Ini
                                            </label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                                   id="current_password" name="current_password" required>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">
                                                <i class="bi bi-lock me-1"></i> Password Baru
                                            </label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" name="password" required>
                                            <small class="text-muted">Minimal 8 karakter</small>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label fw-bold">
                                                <i class="bi bi-lock-fill me-1"></i> Konfirmasi Password Baru
                                            </label>
                                            <input type="password" class="form-control" 
                                                   id="password_confirmation" name="password_confirmation" required>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3 border-top">
                                            <button type="submit" class="btn btn-warning text-white">
                                                <i class="bi bi-shield-check me-1"></i> Update Password
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
@endsection

@section('js')
    <style>
        .form-label {
            color: #495057;
            font-size: 14px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.1);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
            background: linear-gradient(135deg, #ffb300 0%, #ffa000 100%);
        }
        
        .card-header h5 {
            color: #333;
            font-weight: 600;
        }
    </style>
@endsection
