@extends('master')

@section('title', 'Rental Mobil Aris')

@section('konten')
<div class="row">
    @if(session('success-add'))
    <div class="alert alert-success" role="alert">
        {{session('success-add')}}
    </div>
    @endif
    <img class="img-fluid w-75 mx-auto" src="{{url('img/rush.png')}}" alt="rush">
</div>
<div class="row">
    <div class="col">
        <a href="/registrasi" class="btn btn-warning w-100">Register</a>
    </div>
    <div class="col">
        <a href="/login" class="btn btn-primary w-100">Login</a>
    </div>
</div>
@endsection