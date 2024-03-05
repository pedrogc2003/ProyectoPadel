<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    // Campos que se pueden llenar al crear o actualizar un registro de Reserva
    protected $fillable = [
        'dia',
        'hora',
        'id_user',
        'id_pista',
    ];

    // Relación: Una reserva pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Una reserva pertenece a una pista
    public function pista()
    {
        return $this->belongsTo(Pista::class);
    }
}
