@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Daftar Manajemen Pekerjaan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- button cetak, print, pdf, excel --}}
            <a href="javascript:void(0);" onclick="window.print();" class="btn btn-secondary float-left mr-1">Print <i class="fas fa-print"></i></a>
            <a href="{{ route('admin.jobs-pdf') }}" class="btn btn-danger float-left mr-1" target="_blank"> PDF <i
                    class="fas fa-file-pdf"></i></a>
            <a href="{{ route('admin.jobs-excel') }}" class="btn btn-success float-left">Excel <i
                    class="fas fa-file-excel"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Tgl. Mulai</th>
                            <th>Tgl. Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $item)
                            <tr>
                                <td width="5%" class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->order->name }} <b>({{ $item->order->order_number }})</b></td>
                                <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                                <td>
                                    @switch($item->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Dalam Antrian</span>
                                        @break

                                        @case('completed')
                                            <span class="badge badge-success">Selesai</span>
                                        @break

                                        @case('cancelled')
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @break

                                        @case('processing')
                                            <span class="badge badge-primary">Sedang Dikerjakan</span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle delete"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="btn btn-warning btn-circle edit" data-id="{{$item->id}}">
                                        <i class="fas fa-edit"></i>
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

@include('admin.job.status')

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
            $(document).on('click', '.delete', function(e) {
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
                            url: `/admin/jobs/${id}`,
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

            $(document).on('click', '.edit', function(e) {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/admin/jobs/" + id,
                    success: function (response) {
                        console.log(response);

                        $('#status').val(response.status);
                        $('#startDate').val(response.start_date);
                        $('#endDate').val(response.end_date);
                        $('#statusForm').attr('action', `/admin/jobs/${response.id}`);

                        $('#statusModal').modal('show');
                    }
                });
            })
        });
    </script>
@endpush
