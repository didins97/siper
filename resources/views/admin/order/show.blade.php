@extends('app')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <h1 class="h3 text-gray-800 mr-3">{{ $order->order_number }}</h1>
        <h3>
            @switch($order->status)
                @case('pending')
                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                @break

                @case('completed')
                    <span class="badge badge-success">Selesai</span>
                @break

                @case('cancelled')
                    <span class="badge badge-danger">Dibatalkan</span>
                @break

                @case('inprogress')
                    <span class="badge badge-primary">Dalam Proses</span>
                @break

                @default
            @endswitch
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center">
                    <h6 class="m-0 font-weight-bold">Pemesan</h6>
                </div>
                <div class="card-body">
                    <p><b>Nama Pemesan:</b> {{ $order->name }}</p>
                    <hr>
                    <p><b>Nomor Whatsapp:</b> {{ $order->phone }}</p>
                    <hr>
                    <p><b>Email:</b> {{ $order->user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center">
                    <h6 class="m-0 font-weight-bold">Produk</h6>
                </div>
                <div class="card-body">
                    <p><b>Jenis Produk:</b> {{ $order->product->name }}</p>
                    <hr>
                    <p><b>Harga Satuan:</b> {{ $order->price }}</p>
                    <hr>
                    <p><b>Ukuran:</b> {{ $order->size }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center">
                    <h6 class="m-0 font-weight-bold">Detail</h6>
                </div>
                <div class="card-body">
                    <p>
                        <b>Jumlah:</b> {{ $order->qty }}</b>
                    </p>
                    <hr>
                    <p><b>Total Harga:</b> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <hr>
                    <p><b>Tanggal Pemesanan:</b> {{ Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</p>
                    <hr>
                    <p><b>Perkiraan Selesai :</b> {{ Carbon\Carbon::parse($order->expected_date)->format('d F Y') }}</p>
                    <hr>
                    <p><b>Catatan:</b> {{ $order->notes }}</p>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#statusModal">
        Ubah Status
    </button>
@endsection

@section('modal')
    @include('admin.order.status')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/show-order.js') }}"></script>
@endpush
