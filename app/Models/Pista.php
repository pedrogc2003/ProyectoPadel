<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    use HasFactory;

    // Campos que se pueden llenar al crear o actualizar un registro de Pista
    protected $fillable = [
        'numeroPista',
    ];

    // Relación: Una pista puede tener muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación: Una pista puede estar asociada a muchos usuarios (relación muchos a muchos)
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'pista_usuario', 'id_pista', 'id_user');
    }
}
