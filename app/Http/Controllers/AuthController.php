<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function registrasi() {
        return view('registrasi');
    }
    public function login() {
        return view('login');
    }

    public function postRegistrasi(Request $req) {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'sim' => 'required|unique:user',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('registrasi')
                    ->withErrors($validator)
                    ->withInput();
        }
        UsersModel::create($validator->validate());

        return redirect('/')->with('success-add', 'Berhasil Mendaftarkan User');
    }

    public function postLogin(Request $req) {
        $validator = Validator::make($req->all(), [
            'sim' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('login')
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = DB::table('user')->where('sim', $req->input('sim'))->first();
        if ($user->password === $req->password) {
            $req->session()->put('user', $user);
            return redirect('dashboard');
        }
        return redirect('login')
            ->withErrors($validator)
            ->withInput();
    }

    public function logout(Request $req) {
        $req->session()->forget('user');
        return redirect('/');
    }
}
