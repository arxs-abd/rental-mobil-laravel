@extends('master')

@section('title', 'Lihat Transaksi - Rental Mobil Aris')

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
            <li class="breadcrumb-item active" aria-current="page">Daftar Transaksi</li>
        </ol>
    </nav>
</div>

<div class="row">
    @if(session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Merek</th>
                <th scope="col">Model</th>
                <th scope="col">Plat</th>
                <th scope="col">Total Tarif</th>
                <th scope="col">Status</th>
                <th scope="col">Lihat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $trans)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$trans->car->merek}}</td>
                <td>{{$trans->car->model}}</td>
                <td>{{$trans->car->plat}}</td>
                <td>Rp. {{number_format($trans->total_price, 0, ',', '.')}}</td>
                <td>{{$trans->status}}</td>
                <td>
                    <a href="/transaksi-detail?id={{$trans->id}}" class="btn btn-success">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection