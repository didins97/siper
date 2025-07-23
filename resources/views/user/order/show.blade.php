@extends('app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h1 class="h3 text-gray-800 mb-1">Order #{{ $order->order_number }}</h1>
                <p class="text-muted small mb-0">
                    <i class="far fa-calendar-alt mr-1"></i>
                    Ordered on {{ Carbon\Carbon::parse($order->created_at)->format('M d, Y \a\t h:i A') }}
                </p>
            </div>
            <div>
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

                    @default
                @endswitch
            </div>
        </div>

        <div class="row">
            <!-- Customer Information -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user mr-2"></i>Informasi Pemesan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-primary mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Nama Pemesan</h6>
                                <p class="mb-0 text-gray-800">{{ $order->name }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-success mr-3">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Nomor WhatsApp</h6>
                                <p class="mb-0 text-gray-800">{{ $order->phone }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-info mr-3">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Email</h6>
                                <p class="mb-0 text-gray-800">{{ $order->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-box-open mr-2"></i>Detail Produk
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-warning mr-3">
                                <i class="fas fa-tag text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Jenis Produk</h6>
                                <p class="mb-0 text-gray-800">{{ $order->product->name }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-danger mr-3">
                                <i class="fas fa-money-bill-wave text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Harga Satuan</h6>
                                <p class="mb-0 text-gray-800">Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-secondary mr-3">
                                <i class="fas fa-ruler-combined text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Ukuran</h6>
                                <p class="mb-0 text-gray-800">{{ $order->size }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-receipt mr-2"></i>Detail Pesanan
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="border-left-primary p-3 h-100">
                            <h6 class="text-primary font-weight-bold">Jumlah</h6>
                            <p class="mb-0">{{ $order->qty }} item</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="border-left-success p-3 h-100">
                            <h6 class="text-success font-weight-bold">Total Harga</h6>
                            <p class="mb-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="border-left-info p-3 h-100">
                            <h6 class="text-info font-weight-bold">Perkiraan Selesai</h6>
                            <p class="mb-0">{{ Carbon\Carbon::parse($order->expected_date)->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <h6 class="font-weight-bold text-gray-800">Catatan:</h6>
                    <div class="bg-light p-3 rounded">
                        @if ($order->notes)
                            {{ $order->notes }}
                        @else
                            <span class="text-muted">Tidak ada catatan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($order->status == 'pending' || $order->status == 'inprogress')
            <div class="text-center mb-5">
                <button type="button" class="btn btn-danger btn-lg px-5" data-id="{{ $order->id }}" id="cancel">
                    <i class="fas fa-times-circle mr-2"></i> Batalkan Pesanan
                </button>
            </div>
        @endif
    </div>
@endsection

@section('css')
    <style>
        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#cancel').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan membatalkan pemesanan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user.orders.cancel', ':id') }}".replace(':id', id),
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // console.log('response : ' + response);
                            if (response.success === true) {
                                console.log('response.success');
                                Swal.fire("Done!", response.message, "success");
                                // refresh page
                                window.location.reload();
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        }
                    });
                }
            })
        })
    </script>
@endpush
