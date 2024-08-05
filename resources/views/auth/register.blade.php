@extends('layouts.app')

@section('content')
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="name" class="form-control form-control-user" id="exampleInputName"
                        aria-describedby="namaHelp" placeholder="Masukan Nama Lengkap" name="name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                        aria-describedby="emailHelp" placeholder="Masukan Alamat Email" name="email">
                </div>
                {{-- <div class="form-group">
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="operator">Operator</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                        placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="exampleInputConfirmPassword"
                        placeholder="Konfirmasi Password" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Daftar
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="forgot-password.html">Lupa Password</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{ route('login') }}">Sudah Punya Akun? Masuk!</a>
            </div>
        </div>
    </div>
@endsection
