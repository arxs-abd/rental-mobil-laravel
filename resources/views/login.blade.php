@extends('master')

@section('title', 'Login - Rental Mobil')

@section('konten')
<div class="row">
    <img class="img-fluid w-50 mx-auto" src="{{url('img/rush.png')}}" alt="rush">
</div>
<form action="/postLogin" method="post">
    <div class="row">
        @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            Terjadi Kesahalan, Harap Periksa Data Diri Anda
        </div>
        @endif
        <label class="form-label">No SIM</label>
        <input type="text" name="sim" class="form-control">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control mb-3">
        @csrf
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
@endsection