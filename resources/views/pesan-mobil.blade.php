@extends('master')

@section('title', 'Pesan Mobil - Rental Mobil Aris')

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
        <li class="breadcrumb-item active" aria-current="page">Pesan Mobil</li>
    </ol>
    </nav>
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        Terjadi Kesahalan, Harap Periksa Data Anda
    </div>
    @endif
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
    <form action="/postPesanMobil" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$car->id}}">
        <label class="form-label">Merek</label>
        <input type="text" name="merek" class="form-control" disabled value="{{$car->merek}}">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" disabled value="{{$car->model}}">
        <label class="form-label">Plat Kendaraan</label>
        <input type="text" name="plat" class="form-control" disabled value="{{$car->plat}}">
        <label class="form-label">Tarif Per Hari</label>
        <input type="text" id="tarif" name="tarif" class="form-control" disabled value=" {{$car->tarif}}">
        <label for="startDate">Mulai Peminjaman</label>
        <input id="startDate" name="startTime" class="form-control" type="date" value="{{date('Y-m-d')}}" />
        <label for="endDate">Akhir Peminjaman</label>
        <input id="endDate" name="endTime" class="form-control" type="date" value="{{date('Y-m-d', strtotime('+1 day'))}}"/>
        <label class="form-label">Total Tarif</label>
        <input type="text" id="total-tarif" name="tarifx" class="form-control" disabled value="Rp. {{number_format($car->tarif, 0, ',', '.')}}">
        <input type="hidden" id="total" name="total" class="form-control" value="{{$car->tarif}}">
        <button type="submit" class="btn btn-warning mt-3 mb-5">Pesan Mobil</button>
    </form>
</div>
<div class="row">
    <h3>Status Kendaraan</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Awal Peminjaman</th>
                <th scope="col">Akhir Peminjaman</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $trans)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{date("d F Y", strtotime($trans->start_time))}}</td>
                <td>{{date("d F Y", strtotime($trans->end_time))}}</td>
                <td>{{$trans->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script defer>
    const startTime = document.querySelector('#startDate')
    const endTime = document.querySelector('#endDate')
    const tarifx = document.querySelector('#tarifx')
    const tarif = document.querySelector('#tarif')
    const totalTarif = document.querySelector('#total-tarif')
    const total = document.querySelector('#total')

    startTime.addEventListener('change', function(e) {
        addTomorrow()
        count(e)
    })
    endTime.addEventListener('change', function(e) {
       count(e)
    })

    function count(e) {
        e.preventDefault()
        const start = new Date(startTime.value)
        const end = new Date(endTime.value)
        const diff = end - start
        const daysDiff = Math.ceil(diff / (1000 * 60 * 60 * 24))
    
        const result = Number(tarif.value) * Number(daysDiff)
        total.value = result
        totalTarif.value = result.toLocaleString("id-ID", { style: "currency", currency: "IDR" }).replace(/\.\d{2}$/, '')
    }

    function addTomorrow() {
        let today = new Date(startTime.value)
        today.setDate(today.getDate() + 1)

        let tahun = today.getFullYear()
        let bulan = String(today.getMonth() + 1).padStart(2, '0')
        let tanggal = String(today.getDate()).padStart(2, '0')
        endTime.value = tahun + "-" + bulan + "-" + tanggal
    }
</script>
@endsection
