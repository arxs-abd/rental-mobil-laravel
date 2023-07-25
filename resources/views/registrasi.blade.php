@extends('master')

@section('title', 'Login - Rental Mobil')

@section('konten')
<form action="/postRegistrasi" method="post">
    <div class="row">
        @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            Terjadi Kesahalan, Harap Periksa Data Diri Anda
        </div>
        @endif
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{old('alamat')}}">
        <label class="form-label">No Telp</label>
        <input type="text" name="telp" class="form-control" value="{{old('telp')}}">
        <label class="form-label">No SIM</label>
        <input type="text" name="sim" class="form-control" value="{{old('sim')}}">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control mb-3">
        @csrf
        <button type="submit" class="btn btn-warning">Registrasi</button>
    </div>
</form>
@endsection