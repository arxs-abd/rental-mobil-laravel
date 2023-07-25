<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['user_rent_id', 'car_id', 'start_time', 'end_time', 'status', 'total_price'];

    public function user() {
        return $this->belongsTo(UsersModel::class, 'user_id');
    }

    public function car() {
        return $this->belongsTo(CarModel::class, 'car_id');
    }
}
