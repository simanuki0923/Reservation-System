<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $fillable = ['name', 'area', 'genre', 'description', 'image_url',];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'store_id'); 
    }
}
