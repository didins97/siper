@extends('app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Detail Item</h1>

    <div class="card shadow-sm">
        <div class="row g-0">
            <!-- Gambar Produk -->
            <div class="col-md-5 text-center p-3">
                @if ($product->image != 'noimage.jpg')
                    <img class="img-fluid rounded" src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img class="img-fluid rounded" src="{{ asset('assets/img/' . $product->image) }}" alt="{{ $product->name }}">
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="col-md-7">
                <div class="card-body">
                    <h4 class="card-title fw-bold">{{ $product->name }}</h4>
                    <p class="card-text text-muted">{{ $product->desc }}</p>

                    <!-- Daftar Harga -->
                    <div class="mt-3">
                        <h5 class="fw-semibold">Ukuran & Harga</h5>
                        <ul class="list-group">
                            @php
                                $sizes = json_decode($product->sizes);
                                $prices = json_decode($product->prices);
                            @endphp
                            @foreach ($sizes as $index => $size)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $size }}
                                    <span class="badge bg-primary text-white px-3 py-2">Rp {{ number_format($prices[$index], 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tombol Pesan -->
                    <button type="button" class="btn btn-primary btn-lg w-100 mt-4 btn-order" data-id="{{ $product->id }}">
                        <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('user.item.order')
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/js/user/order.js"></script>
@endpush
