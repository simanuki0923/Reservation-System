<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $fillable = ['name', 'address'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'store_id'); // 'store_id' は適切なカラム名に変更
    }
}
