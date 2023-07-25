<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = ['name', 'alamat', 'telp', 'sim', 'password'];

    public function car() {
        return $this->hasMany(CarModel::class, 'user_id');
    }

    public function transaksi() {
        return $this->hasMany(TransaksiModel::class, 'user_rent_id');
    }
}
