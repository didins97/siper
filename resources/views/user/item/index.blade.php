@extends('app')

@section('css')
    <style>
        #sizeOptionsContainer div {
            display: inline-block;
            /* Menjadikan elemen div sebagai inline-block */
            margin-right: 10px;
            /* Jarak antar opsi ukuran */
        }

        #sizeOptionsContainer label {
            margin-left: 5px;
            /* Jarak antara radio button dan label */
        }

        /* Efek hover untuk artikel */
        .article:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Efek hover untuk judul artikel */
        .article-title a:hover {
            color: #ff7f50;
            /* Ubah warna teks saat di-hover */
        }

        /* Efek hover untuk gambar latar belakang artikel */
        .article-image:hover {
            opacity: 0.8;
            /* Ubah kejelasan gambar saat di-hover */
        }

        .article {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
            background-color: #fff;
            border-radius: 3px;
            border: none;
            position: relative;
            margin-bottom: 30px;
        }

        .article .article-header {
            height: 170px;
            position: relative;
            overflow: hidden;
        }

        .article .article-header .article-image {
            background-color: #fbfbfb;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .article .article-header .article-title {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.01) 1%, rgba(0, 0, 0, 0.65) 98%, rgba(0, 0, 0, 0.65) 100%);
            padding: 10px;
        }

        .article .article-header .article-title h2 {
            font-size: 16px;
            line-height: 24px;
        }

        .article .article-header .article-title h2 a {
            font-weight: 700;
            text-decoration: none;
            color: #fff;
        }

        .article .article-details {
            background-color: #fff;
            padding: 20px;
            line-height: 24px;
        }

        .article .article-details .article-cta {
            text-align: center;
        }

        .article .article-header .article-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }

        .article .article-header .article-badge .article-badge-item {
            padding: 7px 15px;
            font-weight: 600;
            color: #fff;
            border-radius: 30px;
            font-size: 12px;
        }

        .article .article-header .article-badge .article-badge-item .ion,
        .article .article-header .article-badge .article-badge-item .fas,
        .article .article-header .article-badge .article-badge-item .far,
        .article .article-header .article-badge .article-badge-item .fab,
        .article .article-header .article-badge .article-badge-item .fal {
            margin-right: 3px;
        }

        .article.article-style-b .article-details .article-title {
            margin-bottom: 10px;
        }

        .article.article-style-b .article-details .article-title h2 {
            line-height: 22px;
        }

        .article.article-style-b .article-details .article-title a {
            font-size: 16px;
            font-weight: 600;
        }

        .article.article-style-b .article-details p {
            color: #34395e;
        }

        .article.article-style-b .article-details .article-cta {
            text-align: right;
        }

        .article.article-style-c .article-header {
            height: 233px;
        }

        .article.article-style-c .article-details .article-category {
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 1px;
            color: #34395e;
        }

        .article.article-style-c .article-details .article-category a {
            font-size: 10px;
            color: #34395e;
            font-weight: 700;
        }

        .article.article-style-c .article-details .article-title {
            margin-bottom: 10px;
        }

        .article.article-style-c .article-details .article-title h2 {
            line-height: 22px;
        }

        .article.article-style-c .article-details .article-title a {
            font-size: 16px;
            font-weight: 600;
        }

        .article.article-style-c .article-details p {
            color: #34395e;
        }

        .article.article-style-c .article-user {
            display: inline-block;
            width: 100%;
            margin-top: 20px;
        }

        .article.article-style-c .article-user img {
            border-radius: 50%;
            float: left;
            width: 45px;
            margin-right: 15px;
        }

        .article.article-style-c .article-user .user-detail-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .article.article-style-c .article-user .user-detail-name a {
            font-weight: 700;
        }

        @media (max-width: 575.98px) {
            .article .article-style-c .article-header {
                height: 225px;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .article {
                margin-bottom: 40px;
            }

            .article .article-header {
                height: 195px !important;
            }

            .article.article-style-c .article-header {
                height: 155px;
            }
        }

        @media (max-width: 1024px) {
            .article.article-style-c .article-header {
                height: 216px;
            }

            .article .article-header {
                height: 155px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row mt-4">
        @foreach ($data as $item)
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b shadow">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('storage/images/products/' . $item->image) }}"
                            style="background-image: url(&quot;{{ asset('storage/images/products/' . $item->image) }}&quot;);">
                        </div>
                        {{-- <div class="article-badge">
                        <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> Trending</div>
                    </div> --}}
                    </div>
                    <div class="article-details">
                        <div class="article-title">
                            <h2><a href="#">{{ $item->name }}</a></h2>
                        </div>
                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto voluptatem tenetur aperiam
                        maiores eaque...</p> --}}
                        <div class="article-cta">
                            {{-- <a href="#">Lihat Detail <i class="fas fa-chevron-right"></i></a> --}}
                            <button type="button" class="btn btn-primary btn-block btn-order"
                                data-id="{{ $item->id }}">Pesan</button>
                            <a href="{{ route('user.items.show', $item->id) }}" class="btn btn-secondary btn-block btn-detail"">Detail</a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endsection

@section('modal')
    @include('user.item.order')
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
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

            // Ketika radio button 'Unggah dari komputer' diubah
            $('#uploadFile').change(function() {
                $('#fileInputSection').show(); // Tampilkan input untuk unggah file
                $('#urlInputSection').hide(); // Sembunyikan input untuk URL
            });

            // Ketika radio button 'Gunakan URL' diubah
            $('#useLink').change(function() {
                $('#fileInputSection').hide(); // Sembunyikan input untuk unggah file
                $('#urlInputSection').show(); // Tampilkan input untuk URL
            });
        });
    </script>
@endpush
