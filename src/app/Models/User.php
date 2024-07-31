<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        
       'name', // Add this line
       'email',
       'password',
        
  

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The restaurants that this user has favorited.
     */
    public function favorites()
    {
        return $this->belongsToMany(Restaurant::class, 'favorites');
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class); 
    }

    /**
     * The reservations made by this user.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    
}
