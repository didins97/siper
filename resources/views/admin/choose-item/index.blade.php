@extends('app')

@section('css')
    <link href="{{ asset('assets/css/user/list-order.css') }}" rel="stylesheet">
    <style>
        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .product-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        }

        .product-details {
            padding: 1.5rem;
        }

        .product-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3em;
        }

        .product-price {
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .price-range-badge {
            font-weight: 700;
            font-size: 0.65rem;
        }

        .btn-order {
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-order:hover {
            transform: translateY(-2px);
        }

        .btn-detail {
            transition: all 0.3s;
        }

        .price-range-badge {
            background-color: rgba(74, 85, 104, 0.1);
            border-radius: 20px;
            padding: 0.25rem 0.75rem;
            font-size: 0.85rem;
        }

        .empty-state {
            min-height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold text-gray-800">Daftar Produk</h2>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-1"></i> Urutkan
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
                    <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
                    <li><a class="dropdown-item" href="#">Nama A-Z</a></li>
                    <li><a class="dropdown-item" href="#">Nama Z-A</a></li>
                </ul>
            </div>
        </div>

        <!-- Product Grid -->
        @if (count($data) > 0)
            <div class="row g-4">
                @foreach ($data as $item)
                    @php
                        $prices = json_decode($item->prices);
                        $minPrice = $prices ? min($prices) : 0;
                        $maxPrice = $prices ? max($prices) : 0;
                    @endphp
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100">
                            <div class="product-image"
                                style="background-image: url('{{ asset($item->image != 'noimage.jpg' ? 'storage/images/products/' . $item->image : 'assets/img/' . $item->image) }}');">
                            </div>
                            <div class="product-details d-flex flex-column">
                                <h5 class="product-title">{{ $item->name }}</h5>
                                <div class="price-range mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-tags me-1"></i>
                                        @if($item->is_custom == 1)
                                            <span class="price-range-badge">Custom</span>
                                        @else
                                        Rp{{ number_format($minPrice, 0, ',', '.') }} -
                                        Rp{{ number_format($maxPrice, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary btn-order py-2"
                                            data-id="{{ $item->id }}">
                                            <i class="fas fa-shopping-cart me-2"></i> Pesan
                                        </button>
                                        <a href="{{ route('admin.choose-items.show', $item->id) }}"
                                            class="btn btn-outline-secondary btn-detail py-2">
                                            <i class="fas fa-info-circle me-2"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state text-center py-5">
                <img src="{{ asset('assets/img/empty-product.svg') }}" alt="No products" style="max-width: 200px;"
                    class="mb-4">
                <h4 class="text-muted mb-3">Belum ada produk tersedia</h4>
                <p class="text-muted">Silahkan hubungi admin untuk menambahkan produk</p>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    @include('admin.choose-item.order')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/user/order.js') }}"></script>
@endpush
