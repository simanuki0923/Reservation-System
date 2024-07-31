<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isAdministrator()
    {
        return $this->role === 'administrator';
    }

    public function isStoreManager()
    {
        return $this->role === 'store_representative';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
