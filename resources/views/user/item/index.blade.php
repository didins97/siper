@extends('app')

@section('css')
    <link href="{{ asset('assets/css/user/list-order.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Override SB Admin styles for this page only */
        .printing-page {
            font-family: 'Poppins', sans-serif;
        }

        .printing-page .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .printing-page .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.15);
        }

        .printing-page .card-img-top {
            height: 160px;
            object-fit: cover;
            object-position: center;
        }

        .printing-page .badge-tag {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            background-color: #f8f9fa;
            color: #3a3b45;
            border: 1px solid #dddfeb;
        }

        .printing-page .product-title {
            font-weight: 600;
            color: #2e3a4d;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3em;
        }

        .printing-page .price-range {
            font-weight: 700;
            color: #4e73df;
        }

        .printing-page .btn-order {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .printing-page .btn-order:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .printing-page .filter-section {
            background: white;
            border-radius: 0.35rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .printing-page .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #4e73df;
        }

        @media (max-width: 768px) {
            .printing-page .filter-section {
                padding: 0.75rem;
            }

            .printing-page .card-img-top {
                height: 140px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid printing-page">
        <!-- Compact Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Layanan Percetakan</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Download Katalog
            </a>
        </div>

        <!-- Simplified Filters -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h6 class="section-title">KATEGORI</h6>
                    <select class="form-control form-control-sm">
                        <option selected>Semua Kategori</option>
                        <option>Kartu Nama</option>
                        <option>Brosur</option>
                        <option>Poster</option>
                        <option>Undangan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="section-title">UKURAN</h6>
                    <select class="form-control form-control-sm">
                        <option selected>Semua Ukuran</option>
                        <option>A4 (21x29.7cm)</option>
                        <option>A5 (14.8x21cm)</option>
                        <option>A6 (10.5x14.8cm)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <h6 class="section-title">URUTKAN</h6>
                    <select class="form-control form-control-sm">
                        <option selected>Paling Sesuai</option>
                        <option>Harga Terendah</option>
                        <option>Harga Tertinggi</option>
                        <option>Terbaru</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row">
            @foreach ($data as $item)
                @php
                    $prices = json_decode($item->prices);
                    $minPrice = $prices ? min($prices) : 0;
                    $maxPrice = $prices ? max($prices) : 0;
                    $isPopular = $item->order_count > 50;
                @endphp
                <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <!-- Product Image -->
                        @php
                            $imagePath = public_path('storage/images/products/' . $item->image);
                            $imageUrl =
                                $imageUrl = \Illuminate\Support\Facades\File::exists($imagePath)
                                    ? asset('storage/images/products/' . $item->image)
                                    : asset('assets/img/noimage.jpg');
                        @endphp

                        <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $item->name }}">


                        <!-- Popular Badge -->
                        @if ($isPopular)
                            <div class="position-absolute" style="top: 10px; right: 10px;">
                                <span class="badge badge-danger">POPULER</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="product-title">{{ $item->name }}</h5>

                            <!-- Product Tags -->
                            <div class="mb-2">
                                @if ($item->size)
                                    <span class="badge-tag mr-1">{{ $item->size }}</span>
                                @endif
                                @if ($item->material)
                                    <span class="badge-tag">{{ $item->material }}</span>
                                @endif
                            </div>

                            <!-- Price Range -->
                            <div class="price-range mb-2">
                                Rp {{ number_format($minPrice, 0, ',', '.') }} - Rp
                                {{ number_format($maxPrice, 0, ',', '.') }}
                            </div>

                            <!-- Minimum Order -->
                            <small class="text-success">
                                <i class="fas fa-check-circle"></i> Min. order {{ $item->min_order ?: 10 }} pcs
                            </small>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="row">
                                <div class="col-7 pr-1">
                                    <button class="btn btn-order btn-sm btn-block text-white" data-id="{{ $item->id }}">
                                        <i class="fas fa-shopping-cart"></i> Pesan
                                    </button>
                                </div>
                                <div class="col-5 pl-1">
                                    <a href="{{ route('user.items.show', $item->id) }}"
                                        class="btn btn-outline-secondary btn-sm btn-block">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('user.item.order')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="{{ asset('assets/js/user/order.js') }}"></script>
@endpush
