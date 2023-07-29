@extends('master')

@section('title', 'Rental Mobil Aris')

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
<div class="row mt-5">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if(session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
        </div>
    @endif
    <div class="col">
        <a href="/cari-mobil" class="btn btn-success">Cari Mobil</a>
        <a href="/tambah-mobil" class="btn btn-primary">Tambah Mobil</a>
        <a href="/transaksi" class="btn btn-warning">Lihat Transaksi</a>
    </div>
</div>
@endsection