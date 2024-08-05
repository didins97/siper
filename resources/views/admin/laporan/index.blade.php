@extends('app')

@section('css')
    <link href="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Laporan</h1>

    <div class="card mb-4">
        <div class="card-header">
            Buat Laporan
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.reports.getReport') }}" id="ReportForm">
                @csrf
                <div class="form-group">
                    <label for="reportType">Pilih Jenis Laporan</label>
                    <div id="reportType">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportType" id="reportOrders" value="orders" required>
                            <label class="form-check-label" for="reportOrders">
                                Laporan Pemesanan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportType" id="reportTasks" value="tasks" required>
                            <label class="form-check-label" for="reportTasks">
                                Laporan Pekerjaan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportType" id="reportProducts" value="products" required>
                            <label class="form-check-label" for="reportProducts">
                                Laporan Produk
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="month">Pilih Bulan</label>
                    <select id="month" name="month" class="form-control" required>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Pilih Tahun</label>
                    <select id="year" name="year" class="form-control" required>
                        @for ($i = now()->year; $i >= 2000; $i--)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
