@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <h1 class="h3 mb-0 text-gray-800 mr-3">Order #{{ $order->order_number }}</h1>
            @switch($order->status)
                @case('pending')
                    <span class="badge badge-pill badge-warning py-2 px-3">
                        <i class="fas fa-clock mr-1"></i> Menunggu Konfirmasi
                    </span>
                @break
                @case('completed')
                    <span class="badge badge-pill badge-success py-2 px-3">
                        <i class="fas fa-check-circle mr-1"></i> Selesai
                    </span>
                @break
                @case('cancelled')
                    <span class="badge badge-pill badge-danger py-2 px-3">
                        <i class="fas fa-times-circle mr-1"></i> Dibatalkan
                    </span>
                @break
                @case('inprogress')
                    <span class="badge badge-pill badge-primary py-2 px-3">
                        <i class="fas fa-spinner mr-1"></i> Dalam Proses
                    </span>
                @break
            @endswitch
        </div>
        <div>
            <span class="text-muted small">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ Carbon\Carbon::parse($order->created_at)->format('d F Y, H:i') }}
            </span>
        </div>
    </div>

    <!-- Customer & Product Cards -->
    <div class="row mb-4">
        <!-- Customer Card -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user mr-1"></i> Informasi Pemesan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Nama Pemesan</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Nomor WhatsApp</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <a href="https://wa.me/{{ $order->phone }}" target="_blank" class="text-decoration-none">
                                        {{ $order->phone }} <i class="fas fa-external-link-alt fa-xs"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Email</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <a href="mailto:{{ $order->user->email }}" class="text-decoration-none">
                                        {{ $order->user->email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-box-open mr-1"></i> Detail Produk
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="mb-3">
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Jenis Produk</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->product->name }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Harga Satuan</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($order->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <label class="small font-weight-bold text-uppercase text-muted mb-1">Ukuran</label>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->size }}</div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-info">
                <i class="fas fa-receipt mr-1"></i> Detail Pesanan
            </h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3 col-6 mb-3">
                    <div class="border-left-info p-3 h-100">
                        <label class="small font-weight-bold text-uppercase text-muted mb-1">Jumlah</label>
                        <div class="h5 font-weight-bold text-gray-800">{{ $order->qty }} Item</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="border-left-primary p-3 h-100">
                        <label class="small font-weight-bold text-uppercase text-muted mb-1">Total Harga</label>
                        <div class="h5 font-weight-bold text-primary">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="border-left-warning p-3 h-100">
                        <label class="small font-weight-bold text-uppercase text-muted mb-1">Tanggal Pemesanan</label>
                        <div class="h5 font-weight-bold text-gray-800">
                            {{ Carbon\Carbon::parse($order->created_at)->format('d F Y') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="border-left-success p-3 h-100">
                        <label class="small font-weight-bold text-uppercase text-muted mb-1">Perkiraan Selesai</label>
                        <div class="h5 font-weight-bold text-gray-800">
                            {{ Carbon\Carbon::parse($order->expected_date)->format('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="mb-4">
                <label class="small font-weight-bold text-uppercase text-muted mb-1">Catatan</label>
                <div class="bg-light p-3 rounded">
                    @if($order->notes)
                        {{ $order->notes }}
                    @else
                        <span class="text-muted">Tidak ada catatan</span>
                    @endif
                </div>
            </div>

            <!-- Design Image Section -->
            @if ($order->path_file)
            <div class="mt-4">
                <label class="small font-weight-bold text-uppercase text-muted mb-1">Gambar Desain</label>
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/images/orders/' . $order->path_file) }}"
                         alt="Gambar Desain"
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; border: 1px solid #eee;">
                </div>
                <div class="text-center">
                    <a href="{{ asset('storage/images/orders/' . $order->path_file) }}"
                       target="_blank"
                       class="btn btn-outline-primary btn-icon-split mr-2">
                        <span class="icon">
                            <i class="fas fa-eye"></i>
                        </span>
                        <span class="text">Lihat Gambar</span>
                    </a>
                    <a href="{{ asset('storage/images/orders/' . $order->path_file) }}"
                       download
                       class="btn btn-outline-success btn-icon-split">
                        <span class="icon">
                            <i class="fas fa-download"></i>
                        </span>
                        <span class="text">Download</span>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Status Update Button -->
    <div class="text-center mb-5">
        <button type="button"
                class="btn btn-primary btn-icon-split btn-lg px-3"
                data-toggle="modal"
                data-target="#statusModal">
            <span class="icon">
                <i class="fas fa-sync-alt"></i>
            </span>
            <span class="text">Ubah Status Pesanan</span>
        </button>
    </div>
</div>
@endsection

@section('modal')
    @include('admin.order.status')
@endsection

@section('styles')
<style>
    .border-left-primary { border-left: 4px solid #4e73df; }
    .border-left-success { border-left: 4px solid #1cc88a; }
    .border-left-info { border-left: 4px solid #36b9cc; }
    .border-left-warning { border-left: 4px solid #f6c23e; }
    .card-header { border-bottom: 1px solid rgba(0,0,0,.05); }
    .btn-icon-split {
        position: relative;
        padding-left: 3.5rem;
        text-align: left;
    }
    .btn-icon-split .icon {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background-color: rgba(0,0,0,0.1); */
    }
    /* .btn-icon-split:hover .icon {
        background-color: rgba(0,0,0,0.15);
    } */
</style>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/show-order.js') }}"></script>
@endpush
