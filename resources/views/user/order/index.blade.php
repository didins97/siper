@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">List Item</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Order</th>
                            <th>Nama Pemesan</th>
                            <th>Jenis Item</th>
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

                                        @default
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('user.orders.show', $item->id) }}"
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

    <script>
        $(document).ready(function() {
            $('.delete').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apa anda yakin untuk menghapus ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: `/admin/orders/${id}`,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(results) {
                                if (results.success === true) {
                                    Swal.fire("Done!", results.message, "success");
                                    location.reload();
                                } else {
                                    Swal.fire("Error!", results.message, "error");
                                }
                            }
                        });
                    }
                })
            })
        });
    </script>
@endpush
