@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Daftar Item / Produk</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- button cetak, print, pdf, excel --}}
            <a href="javascript:void(0);" onclick="window.print();" class="btn btn-secondary float-left mr-1">Print <i
                    class="fas fa-print"></i></a>
            <a href="{{ route('admin.products-pdf') }}" class="btn btn-danger float-left mr-1" target="_blank"> PDF <i
                    class="fas fa-file-pdf"></i></a>
            <a href="{{ route('admin.products-excel') }}" class="btn btn-success float-left">Excel <i
                    class="fas fa-file-excel"></i></a>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addItem">
                Tambah Item <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td width="5%" class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $item->name }}
                                    <sup>
                                        @if ($item->is_active)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                    </sup>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/images/products/' . $item->image) }}" width="100" />
                                    {{-- <img src="{{$item->image}}" width="100" /> --}}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle delete"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-info btn-circle edit"
                                        data-id="{{ $item->id }}">
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

@section('modal')
    @include('admin.item.add')
    @include('admin.item.edit')
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
        $(document).ready(function() {
            // preview image
            function setupImagePreview(input, previewSelector) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(event) {
                    $(previewSelector).attr('src', event.target.result);
                };
            }

            /* function Tambah Item */
            $("input[data-preview]").change(function() {
                var input = $(this);
                var previewSelector = input.data('preview');
                setupImagePreview(input[0], previewSelector);
            });

            var formCounter = 0;
            $(document).on('click', '.btn-multiple', function(e) {
                formCounter++;
                console.log(formCounter);

                var objTo = document.getElementById('dynamicForm');
                var divTest = document.createElement('div');
                divTest.setAttribute('class', `form-row sipre${formCounter}`);
                divTest.innerHTML = `
                    <div class="form-group col">
                        <label for="size">Ukuran</label>
                        <input type="text" class="form-control" id="size" name="sizes[]">
                    </div>
                    <div class="form-group col">
                        <label for="price">Harga</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="price" name="prices[]">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-danger btn-flat btn-remove"><i class="fas fa-minus"></i></button>
                            </span>
                        </div>
                    </div>
                `;
                objTo.appendChild(divTest);
            });

            $(document).on('click', '.btn-remove', function(e) {
                $(this).parents('.form-row').remove();
                formCounter--;
            });

            /* function Edit Item */
            $("input[data-edit-preview]").change(function() {
                var input = $(this);
                var previewSelector = input.data('edit-preview');
                setupImagePreview(input[0], previewSelector);
            });

            var formCounterEdit = 0;
            $(document).on('click', '.btn-multiple-edit', function(e) {
                formCounterEdit++;
                var objTo = document.getElementById('EditdynamicForm');
                var divTest = document.createElement('div');
                divTest.setAttribute('class', `form-row sipre-edit${formCounterEdit}`);
                divTest.innerHTML = `
                    <div class="form-group col">
                        <label for="size">Ukuran</label>
                        <input type="text" class="form-control" id="size" name="sizes[]">
                    </div>
                    <div class="form-group col">
                        <label for="price">Harga</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="price" name="prices[]">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-danger btn-flat btn-remove-edit"><i class="fas fa-minus"></i></button>
                            </span>
                        </div>
                    </div>
                `;
                objTo.appendChild(divTest);
            });

            $(document).on('click', '.btn-remove-edit', function(e) {
                $(this).parents('.form-row').remove();
                formCounterEdit--;
            });

            $(document).on('click', '.edit', function(e) {
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: `/admin/products/${id}/edit`,
                    success: function(response) {
                        console.log(response);
                        $('#Editname').val(response.name);
                        $('#Editprice').val(response.price);
                        $('#Editstock').val(response.stock);
                        $('#Editsize').val(response.size);
                        $('#Editdescription').val(response.desc);
                        $('#editCustomSwitch1').prop('checked', response.is_active);
                        $('.edit-preview').attr('src',
                            `/storage/images/products/${response.image}`);
                        $('#EditForm').attr('action', `/admin/products/${response.id}`);

                        // Dekode JSON sizes dan prices menjadi array
                        var sizesArray = JSON.parse(response.sizes);
                        var pricesArray = JSON.parse(response.prices);

                        $('#EditdynamicForm').empty();

                        for (var i = 0; i < sizesArray.length; i++) {
                            var size = sizesArray[i];
                            var price = pricesArray[i];

                            // Menambahkan form dinamis dengan data ukuran dan harga
                            var dynamicFormHtml = `
                                <div class="form-row ${ i > 0 ? 'sipre-edit' + i : '' }">
                                    <div class="form-group col">
                                        <label for="size">Ukuran</label>
                                        <input type="text" class="form-control" id="size" name="sizes[]" value="${size}">
                                    </div>
                                    <div class="form-group col">
                                        <label for="price">Harga</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" id="price" name="prices[]" value="${price}">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-${i > 0 ? 'danger btn-remove-edit' : 'success btn-multiple-edit'} btn-flat"><i class="fas ${i > 0 ? 'fa-minus' : 'fa-plus'}"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#EditdynamicForm').append(dynamicFormHtml);

                            formCounterEdit = i + 1;
                        }

                    }
                });
                $('#editItem').modal('show');
            })

            $(document).on('click', '.delete', function(e) {
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
                            url: `/admin/products/${id}`,
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

        })
    </script>
@endpush
