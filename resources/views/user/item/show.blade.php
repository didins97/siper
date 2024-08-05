@extends('app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Detail Item</h1>
    <div class="card">
        <div class="row">
            <div class="col mt-2">
                <img class="product-img p-2" src="{{ asset('storage/images/products/' . $product->image) }}" width="100%">
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
        <button type="button" class="btn btn-primary btn-block btn-order">Pesan</button>
    </div>
@endsection

@section('modal')
    @include('user.item.order')
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-order').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/user/items/sizes-prices/" + id,
                    success: function(response) {
                        // Menggunakan variabel sizeOptionsHtml di luar loop untuk menyimpan hasil kumulatif
                        var sizeOptionsHtml = '';

                        for (var i = 0; i < response.sizes.length; i++) {
                            var size = response.sizes[i];
                            var price = response.prices[i];

                            // Menambahkan opsi ukuran ke dalam sizeOptionsHtml secara kumulatif
                            sizeOptionsHtml += `
                                <div>
                                    <input type="radio" name="size" value="${size}" data-price="${price}">
                                    <label for="label">${size} - Rp. ${price}</label>
                                    <input type="hidden" name="price">
                                </div>
                            `;
                        }

                        // Setelah loop selesai, tambahkan sizeOptionsHtml ke dalam #sizeOptionsContainer
                        $('#sizeOptionsContainer').html(sizeOptionsHtml);

                        $('input[name="size"]').on('change', function() {
                            var price = $(this).data('price');
                            $('#price').val(price);

                            console.log(price);

                            // buat input hidden
                            $('input[name="price"]').val(price);
                        })

                    }
                });

                $('#OrderForm').attr('action', '/user/create-order/' + id);

                // Tampilkan modal
                $('#orderModal').modal('show');
            })
        });
    </script>
@endpush
