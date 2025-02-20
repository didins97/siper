@extends('app')

@section('css')
    <link href="{{ asset('assets/css/user/list-order.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mt-4">
        @foreach ($data as $item)
            @php
                // Mengubah JSON menjadi array
                $prices = json_decode($item->prices);

                // Pastikan array tidak kosong sebelum mengambil min dan max
                $minPrice = $prices ? min($prices) : 0;
                $maxPrice = $prices ? max($prices) : 0;
            @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card product-card shadow-sm mt-3">
                    <div class="product-image"
                        style="background-image: url('{{ asset($item->image != 'noimage.jpg' ? 'storage/images/products/' . $item->image : 'assets/img/' . $item->image) }}');">
                    </div>
                    <div class="product-details">
                        <h5 class="product-title">{{ $item->name }}</h5>
                        <p class="product-price">
                            Rp. {{ number_format($minPrice, 0, ',', '.') }} - Rp.
                            {{ number_format($maxPrice, 0, ',', '.') }}
                        </p>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-primary btn-order" data-id="{{ $item->id }}">
                                <i class="fas fa-shopping-cart"></i> Pesan
                            </button>
                            <a href="{{ route('admin.choose-items.show', $item->id) }}"
                                class="btn btn-outline-secondary btn-detail">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
