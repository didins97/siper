@extends('app')

@section('css')
<style>
    .dashboard-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .profile-image-container {
        background: linear-gradient(135deg, #f6f9fc 0%, #e9f2fb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        height: 100%;
    }

    .profile-image {
        max-width: 220px;
        filter: drop-shadow(0 4px 12px rgba(74, 115, 223, 0.2));
    }

    .info-section {
        padding: 2rem;
    }

    .order-badge {
        background-color: #4e73df;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 1.1rem;
        display: inline-block;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(78, 115, 223, 0.3);
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btn-save {
        background-color: #4e73df;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }

    .btn-save:hover {
        background-color: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
    }

    .btn-password {
        background-color: #f8f9fc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: #4a5568;
        transition: all 0.3s;
    }

    .btn-password:hover {
        background-color: #edf2f7;
        border-color: #cbd5e0;
    }

    @media (max-width: 768px) {
        .profile-image-container {
            padding: 1.5rem;
        }

        .profile-image {
            max-width: 160px;
        }

        .info-section {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Pengguna</h1>
        <div class="d-none d-sm-block">
            <span class="text-muted">Terakhir login: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y H:i') : 'Belum pernah' }}</span>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="card dashboard-card">
        <div class="card-body p-0">
            <div class="row no-gutters">
                <!-- Profile Image Section -->
                <div class="col-lg-4">
                    <div class="profile-image-container">
                        <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="Profile" class="profile-image">
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-8">
                    <div class="info-section">
                        <div class="order-badge">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Total Pemesanan: <span id="total-order">{{ auth()->user()->orders()->count() }}</span>
                        </div>

                        <form action="{{ route('user.profile.update', auth()->user()->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group mb-4">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ auth()->user()->email }}">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-password mr-3" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fas fa-key mr-2"></i> Ubah Password
                                </button>
                                <button type="submit" class="btn btn-save text-white">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('user.password-update')
@endsection
