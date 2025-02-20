@extends('app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Detail Item</h1>
    <div class="card">
        <div class="row">
            <div class="col mt-2">
                @if ($product->image != 'noimage.jpg')
                    <img class="product-img p-2" src="{{ asset('storage/images/products/' . $product->image) }}" width="100%">
                @else
                    <img class="product-img p-2" src="{{ asset('assets/img/' . $product->image) }}" width="100%">
                @endif
            </div>
            <div class="col mt-2">
                <div class="desc p-1 d-flex justify-content-between">
                    <h4>{{ $product->name }}<h4>
                </div>
                <div class="item-desc">
                    {{ $product->desc }}
                </div>
                <div class="item-sizes mt-2">
                    <ul class="list-group">
                        @for ($i = 0; $i < count(json_decode($product->sizes)); $i++)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ json_decode($product->sizes)[$i] }}
                                <span class="badge badge-primary badge-pill">Rp
                                    {{ json_decode($product->prices)[$i] }}</span>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-block btn-order" data-id="{{ $product->id }}">Pesan</button>
    </div>
@endsection

@section('modal')
    @include('admin.choose-item.order')
@endsection


@push('scripts')
    <script src="{{ asset('assets') }}/js/admin/order.js"></script>
@endpush
