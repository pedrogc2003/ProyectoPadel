<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'rol'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación: Un usuario puede tener muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación: Un usuario puede estar asociado a muchas pistas (relación muchos a muchos)
    public function pistas()
    {
        return $this->belongsToMany(Pista::class, 'pista_usuario', 'id_user', 'id_pista')
                    ->withPivot('fecha_inicio', 'fecha_fin')
                    ->withTimestamps();
    }
}
