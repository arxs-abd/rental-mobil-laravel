<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car';
    protected $fillable = ['merek', 'model', 'plat', 'tarif', 'user_id'];

    public function user() {
        return $this->belongsTo(UsersModel::class, 'user_id');
    }

    public function transaksi() {
        return $this->hasMany(TransaksiModel::class, 'car_id');
    }
}
