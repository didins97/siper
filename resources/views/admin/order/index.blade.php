@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Daftar Pemesanan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- button cetak, print, pdf, excel --}}
            <a href="javascript:void(0);" onclick="window.print();" class="btn btn-secondary float-left mr-1">Print <i
                    class="fas fa-print"></i></a>
            <a href="{{ route('admin.orders-pdf') }}" class="btn btn-danger float-left mr-1" target="_blank"> PDF <i
                    class="fas fa-file-pdf"></i></a>
            <a href="{{ route('admin.orders-excel') }}" class="btn btn-success float-left">Excel <i
                    class="fas fa-file-excel"></i></a>
            <a href="{{ route('admin.choose-items.index') }}" class="btn btn-primary float-right"> Pesan Offline <i class="fas fa-arrow-right"></i> </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Order</th>
                            <th>Nama Pemesan</th>
                            <th>Jenis Item</th>
                            @if (auth()->user()->role == 'admin')
                                <th>Pesan</th>
                            @endif
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td width="5%" class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->product->name }}</td>
                                @if (auth()->user()->role == 'admin')
                                    <td>
                                        @if ($item->order_type == 'online')
                                            <span class="badge badge-success">Online</span>
                                        @else
                                            <span class="badge badge-info">Offline</span>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    @switch($item->status)
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

                                        @case('menunggu_pembayaran')
                                            <span class="badge badge-secondary">Menunggu Pembayaran</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle delete"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $item->id) }}"
                                        class="btn btn-info btn-circle edit">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- <a href="#" class="btn btn-warning btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- {{ $orders->links('pagination::bootstrap-4') }} --}}
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets') }}/js/demo/datatables-demo.js"></script>

    <!-- Link jsPDF dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets') }}/js/user/list-order.js"></script>
@endpush
