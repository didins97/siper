@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Management User</h1>

    <div class="row">
        <div class="col-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td width="5%" class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            @switch($item->role)
                                                @case('admin')
                                                {{-- badge --}}
                                                <span class="badge badge-primary">Admin</span>
                                                    @break
                                                @case('user')
                                                <span class="badge badge-success">User</span>
                                                    @break
                                                @case('operator')
                                                <span class="badge badge-warning">Operator</span>
                                                    @break
                                                @default

                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-circle delete"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-warning btn-circle edit"
                                                data-id="{{ $item->id }}">
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
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" id="formUser">
                        @csrf
                        <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                          <label for="confirmPassword">Password Konfirmasi</label>
                          <input type="password" class="form-control" id="confirmPassword" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="role">Level</label>
                            <select name="role" id="role" class="form-control" disabled>
                                <option value="operator" checked>Operator</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Link jsPDF dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
    </script>


    <!-- Page level custom scripts -->
    <script src="{{ asset('assets') }}/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.edit').on('click', function () {
                let id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: `/admin/users/${id}/edit`,
                    success: function(response) {
                        // console.log(response);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#role').val(response.role);
                        $('#formUser').attr('action', `/admin/users/${response.id}`);
                    }
                });
            })

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
                            url: `/admin/users/${id}`,
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
