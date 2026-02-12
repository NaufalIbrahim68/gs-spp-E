@extends('layouts.front')
@section('title', 'Profile')
@section('content')
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Profile</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('front.index') }}">Home</a></li>
                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    <li class="current">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="profile" class="account section">
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
                    <div class="content-area">
                        <div class="section-header" data-aos="fade-up">
                            <h2><i class="bi bi-person-circle me-2"></i>Informasi Profile</h2>
                            <p class="text-muted">Update informasi profil dan data pribadi Anda</p>
                        </div>

                        <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                            <div class="card-body p-4">
                                <form action="{{ route('customer.profile.update') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label fw-bold">
                                                <i class="bi bi-person me-1"></i> Nama Lengkap
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number" class="form-label fw-bold">
                                                <i class="bi bi-telephone me-1"></i> Nomor Telepon
                                            </label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                                   id="phone_number" name="phone_number" value="{{ old('phone_number', $customer->phone_number) }}" required>
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label fw-bold">
                                                <i class="bi bi-geo-alt me-1"></i> Alamat
                                            </label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                                      id="address" name="address" rows="3">{{ old('address', $customer->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="district_id" class="form-label fw-bold">
                                                <i class="bi bi-map me-1"></i> Kecamatan
                                            </label>
                                            <select class="form-select @error('district_id') is-invalid @enderror" 
                                                    id="district_id" name="district_id">
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" 
                                                        {{ old('district_id', $customer->district_id) == $district->id ? 'selected' : '' }}>
                                                        {{ $district->name }}, {{ $district->city->type }} {{ $district->city->name }}, {{ $district->city->province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_birth" class="form-label fw-bold">
                                                <i class="bi bi-calendar me-1"></i> Tanggal Lahir
                                            </label>
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $customer->date_of_birth) }}">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="gender" class="form-label fw-bold">
                                                <i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin
                                            </label>
                                            <select class="form-select @error('gender') is-invalid @enderror" 
                                                    id="gender" name="gender">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                                <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end pt-3 border-top">
                                        <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary me-2">
                                            <i class="bi bi-x-circle me-1"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
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
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8555 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }
    </style>
@endsection
