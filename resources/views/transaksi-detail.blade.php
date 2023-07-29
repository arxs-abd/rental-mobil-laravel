@extends('master')

@section('title', 'Detail Transaksi - Rental Mobil Aris')

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
        <li class="breadcrumb-item"><a href="/transaksi">Daftar Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaksi Detail</li>
    </ol>
    </nav>
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        Terjadi Kesahalan, Harap Periksa Data Diri Anda
    </div>
    @endif
    @if(session('success-change'))
    <div class="alert alert-success" role="alert">
        {{session('success-change')}}
    </div>
    @endif
    <form action="/changeStatus" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$transaksi->id}}">
        <label class="form-label">Merek</label>
        <input type="text" name="merek" class="form-control" disabled value="{{$transaksi->car->merek}}">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" disabled value="{{$transaksi->car->model}}">
        <label class="form-label">Plat Kendaraan</label>
        <input type="text" name="plat" class="form-control" disabled value="{{$transaksi->car->plat}}">
        <label class="form-label">Tarif Per Hari</label>
        <input type="text" id="tarif" name="tarif" class="form-control" disabled value="Rp. {{number_format($transaksi->car->tarif, 0, ',', '.')}}">
        <label for="startDate">Mulai Peminjaman</label>
        <input id="startDate" name="startTime" class="form-control" type="date" disabled value="{{date($transaksi->start_time)}}" />
        <label for="endDate">Akhir Peminjaman</label>
        <input id="endDate" name="endTime" class="form-control" type="date" disabled value="{{date($transaksi->end_time)}}"/>
        <label class="form-label">Total Tarif</label>
        <input type="text" id="total-tarif" name="tarifx" class="form-control" disabled value="Rp. {{number_format($transaksi->total_price, 0, ',', '.')}}">
        <label class="form-label">Status</label>
        <input type="text" name="statusx" class="form-control" disabled value="{{$transaksi->status}}">
        <input type="hidden" name="status" class="form-control" value="{{$transaksi->status}}">
        @if ($transaksi->status === 'Meminjam')
            <button type="submit" class="btn btn-warning mt-3 mb-5">Kembalikan Mobil</button>
            @elseif ($transaksi->status === 'Telah Mengembalikan')
            <button type="submit" disabled class="btn btn-success mt-3 mb-5">Telah Mengembalikan Mobil</button>
        @endif
    </form>
</div>
@endsection
