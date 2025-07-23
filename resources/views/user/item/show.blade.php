@extends('app')

@section('content')
    <div class="container py-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Detail Item</h1>
            <a href="{{ route('user.items.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>

        <div class="card shadow-lg overflow-hidden">
            <div class="row g-0">
                <!-- Product Image -->
                <div class="col-lg-5 col-xl-4">
                    <div class="p-4 h-100 d-flex align-items-center justify-content-center bg-light">
                        @if ($product->image != 'noimage.jpg')
                            <img class="img-fluid rounded-3" src="{{ asset('storage/images/products/' . $product->image) }}"
                                alt="{{ $product->name }}" style="max-height: 400px; object-fit: contain;">
                        @else
                            <img class="img-fluid rounded-3" src="{{ asset('assets/img/' . $product->image) }}"
                                alt="{{ $product->name }}" style="max-height: 400px; object-fit: contain;">
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-7 col-xl-8">
                    <div class="card-body p-4 p-xl-5">
                        <!-- Product Title -->
                        <h1 class="h2 fw-bold text-primary mb-3">{{ $product->name }}</h1>

                        <!-- Product Description -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-2">Deskripsi Produk</h5>
                            <p class="text-muted mb-0">{{ $product->desc }}</p>
                        </div>

                        <!-- Custom Badge -->
                        @if ($product->is_custom == 1)
                            <div class="alert alert-info d-inline-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-2"></i>
                                Produk ini dapat disesuaikan sesuai kebutuhan Anda
                            </div>
                        @endif

                        <!-- Price List -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-3">
                                <i class="fas fa-tags me-2 text-primary"></i>Daftar Harga
                            </h5>

                            @if ($product->is_custom == 1)
                                <div class="alert alert-warning py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-ruler-combined fa-2x me-3 text-warning"></i>
                                        <div>
                                            <h6 class="mb-1 fw-bold">Ukuran Custom</h6>
                                            <p class="mb-0">Harga menyesuaikan dengan spesifikasi yang Anda butuhkan</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ukuran</th>
                                                <th class="text-end">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sizes = json_decode($product->sizes);
                                                $prices = json_decode($product->prices);
                                            @endphp
                                            @foreach ($sizes as $index => $size)
                                                <tr>
                                                    <td class="fw-semibold">{{ $size }}</td>
                                                    <td class="text-end fw-bold text-primary">
                                                        Rp {{ number_format($prices[$index], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <!-- Order Button -->
                        <button type="button" class="btn btn-primary btn-lg w-100 py-3 mt-3 btn-order"
                            data-id="{{ $product->id }}">
                            <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
                        </button>

                        <!-- Additional Info -->
                        <div class="d-flex flex-wrap justify-content-between mt-4 pt-3 border-top">
                            <div class="d-flex align-items-center me-3 mb-2">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                <small class="text-muted">Garansi kualitas produk</small>
                            </div>
                            <div class="d-flex align-items-center me-3 mb-2">
                                <i class="fas fa-truck text-info me-2"></i>
                                <small class="text-muted">Pengiriman cepat</small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-headset text-secondary me-2"></i>
                                <small class="text-muted">Bantuan 24/7</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('user.item.order')
@endsection

@push('styles')
    <style>
        .card {
            border: none;
            border-radius: 12px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .btn-order {
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets') }}/js/user/order.js"></script>
@endpush
