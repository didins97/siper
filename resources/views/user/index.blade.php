@extends('app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Gambar di sebelah kiri -->
                    <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="Gambar" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <!-- Informasi dan Form input di sebelah kanan -->
                    <div class="mb-3">
                        <h5>Total Pemesanan: <span id="total-order">{{ auth()->user()->orders()->count() }}</span></h5>
                    </div>
                    <form action="{{ route('user.profile.update', auth()->user()->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ auth()->user()->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-toggle="modal" data-target="#exampleModal">
                            Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('user.password-update')
@endsection
