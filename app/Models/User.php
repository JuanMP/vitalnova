<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dni',
        'telephone',
        'birthday',
        'image',
        'rol',
  
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //devolvemos admin si es
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }


    public function isDoctor()
    {
        return $this->rol === 'doctor';
    }

    public function isReceptionist()
    {
        return $this->rol === 'receptionist';
    }

    //PARA ROL ESPECÍFICO
    public function hasRol($rol)
    {
        return $this->rol === $rol;
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

}
