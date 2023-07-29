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
            <li class="breadcrumb-item active" aria-current="page">Cari Mobil</li>
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
    <form action="/cari-mobil" method="get">
        @csrf
        <div class="col-6">
            <label class="form-label">Merek</label>
            <input type="text" name="merek" class="form-control" value="{{old('merek')}}">
        </div>
        <div class="col-6">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" value="{{old('model')}}">
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" name="avail" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Tersedia Hari Ini
            </label>
        </div>
        <button type="submit" class="btn btn-success mt-3">Cari Mobil</button>
    </form>
</div>

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Merek</th>
                <th scope="col">Model</th>
                <th scope="col">Plat</th>
                <th scope="col">Tarif</th>
                <th scope="col">Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allCar as $car)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$car->merek}}</td>
                <td>{{$car->model}}</td>
                <td>{{$car->plat}}</td>
                <td>{{'Rp. ' . number_format($car->tarif, 0, ',', '.')}}</td>
                <td>
                    <a href="/pesan-mobil?id={{$car->id}}" class="btn btn-success">Pesan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection