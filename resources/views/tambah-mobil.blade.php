@extends('master')

@section('title', 'Tambah Mobil - Rental Mobil Aris')

@section('konten')
<div class="row">
    <div class="col-10">
        <h3>Selamat Datang, {{$name}}</h3>
    </div>
    <div class="col-2">
        <form action="/logout" method="post">
            @csrf
            <button class="btn btn-danger d-block ">Logout</button>
        </form>
    </div>
</div>
<div class="row">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Mobil</li>
    </ol>
    </nav>
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        Terjadi Kesahalan, Harap Periksa Data Diri Anda
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif
    <form action="/postMobil" method="post">
        @csrf
        <label class="form-label">Merek</label>
        <input type="text" name="merek" class="form-control" value="{{old('merek')}}">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{old('model')}}">
        <label class="form-label">Plat Kendaraan</label>
        <input type="text" name="plat" class="form-control" value="{{old('plat')}}">
        <label class="form-label">Tarif</label>
        <input type="text" name="tarif" class="form-control" value="{{old('tarif')}}">
        <button type="submit" class="btn btn-warning mt-3">Tambah Mobil</button>
    </form>
</div>
@endsection