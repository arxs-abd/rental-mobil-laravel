<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\TransaksiModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function dashboard(Request $req) {

        if (!$req->session()->get('user')) {
            return redirect('/');
        }

        $user = $req->session()->get('user');

        $data = [
            'name' => $user->name,
        ];
        return view('dashboard', $data);
    }

    public function cariMobil(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }
        $field = ['merek', 'model'];
        $where = [];
        $user = $req->session()->get('user');
        
        if ($req->query('merek') || $req->query('model')) {
            foreach ($field as $f) {
                if ($req->input($f) !== null) $where[$f] = $req->input($f);
            }
            $car = CarModel::where($where)->get();
            $data = [
                'name' => $user->name,
                'allCar' => $car,
            ];
            return view('cari-mobil', $data);
        }

        $data['name'] = $user->name;
        $allCar = CarModel::all();
        $data['allCar'] = $allCar;
        if ($req->input('avail')) {
            $i = 0;
            foreach($allCar as $car) {
                $allTransaksi = TransaksiModel::where(['car_id' => $car->id, 'status' => 'Meminjam'])->get();
                foreach ($allTransaksi as $transaksi) {
                    if (DashboardController::isDateInRange(date('Y-m-d'), $transaksi->start_time, $transaksi->end_time)) {
                        unset($allCar[$i]);
                    }
                }
                $i++;
            }
            $data['allCar'] = $allCar;
        }
        // dd($data['allCar']);
        return view('cari-mobil', $data);
    }

    public function tambahMobil(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }

        $user = $req->session()->get('user');

        $data = [
            'name' => $user->name,
        ];
        return view('tambah-mobil', $data);
    }

    public function postMobil(Request $req) {
        $validator = Validator::make($req->all(), [
            'merek' => 'required',
            'model' => 'required',
            'plat' => 'required',
            'tarif' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('tambah-mobil')
                    ->withErrors($validator)
                    ->withInput();
        }
        $mobil = $validator->validate();
        $mobil['user_id'] = $req->session()->get('user')->id;

        CarModel::create($mobil);

        return redirect('tambah-mobil')->with('success', 'Berhasil Menambahkan Mobil');
        dd($mobil);
    }

    public function pesanMobil(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }

        $user = $req->session()->get('user');
        $car = CarModel::where(['id' => (int) $req->query('id')])->first();
        $transaksi = TransaksiModel::where(['car_id' => (int) $req->query('id'), 'status' => 'Meminjam'])->get();
        $data = [
            'name' => $user->name,
            'car' => $car,
            'transaksi' => $transaksi,
        ];
        return view('pesan-mobil', $data);
    }
    
    public function postPesanMobil(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }
        $user = $req->session()->get('user');
        $data = [
            'user_rent_id' => $user->id,
            'car_id' => $req->input('id'),
            'start_time' => $req->input('startTime'),
            'end_time' => $req->input('endTime'),
            'total_price' => $req->input('total'),
            'status' => 'Meminjam',
        ];
        $checkTransaksi = TransaksiModel::where(['car_id' => $data['car_id'], 'status' => 'Meminjam'])->get();
        foreach ($checkTransaksi as $transaksi) {
            if (DashboardController::isDateInRange($data['start_time'], $transaksi->start_time, $transaksi->end_time) || DashboardController::isDateInRange($data['end_time'], $transaksi->start_time, $transaksi->end_time)) return redirect('pesan-mobil?id=' . $data['car_id'])->with('fail', 'Gagal Melakukan Booking Kendaraan');
        }
        TransaksiModel::create($data);
        return redirect('dashboard')->with('success', 'Berhasil Melakukan Booking Pinjam Kendaraan');
    }

    public function transaksi(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }
        
        $user = $req->session()->get('user');
        $transaksi = UsersModel::find($user->id)->transaksi;

        $data = [
            'name' => $user->name,
            'transaksi' => $transaksi
        ];
        return view('transaksi', $data);
    }
    public function transaksiDetail(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }
        
        $user = $req->session()->get('user');
        $transaksi = TransaksiModel::where(['id' => $req->query('id'), 'user_rent_id' => $user->id])->first();
        if ($req->query('id') === null) {
            return redirect('/dashboard');
        }

        if (!$transaksi) return redirect('/transaksi')->with('fail', 'Anda Tidak Memiliki Akses !');

        $data = [
            'name' => $user->name,
            'transaksi' => $transaksi
        ];
        return view('transaksi-detail', $data);
    }

    public function postChangeStatus(Request $req) {
        if (!$req->session()->get('user')) {
            return redirect('/');
        }
        $transaksi = TransaksiModel::find($req->input('id'));
        if ($req->input('status') === 'Meminjam') {
            $transaksi->status = 'Telah Mengembalikan';
            $transaksi->save();
            return redirect('/transaksi-detail?id=' . $req->input('id'))->with('success-change', 'Berhasil Mengembalikan Mobil');
        }
    }

    function isDateInRange($inputDate, $startDate, $endDate) {
        $inputTimestamp = strtotime($inputDate);
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        return ($inputTimestamp >= $startTimestamp && $inputTimestamp <= $endTimestamp);
    }
}
