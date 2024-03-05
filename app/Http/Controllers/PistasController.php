<?php

namespace App\Http\Controllers;

use App\Models\Pista; // Importa el modelo de Pista
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PistasController extends Controller
{
    // Método para mostrar la vista de añadir pista
    public function anadirPista()
    {
        return view('InicioTrabajador.AnadirPista');
    }

    // Método para mostrar la vista de ver pistas
    public function verVistas()
    {
        // Obtener todas las pistas desde la base de datos
        $pistas = Pista::all();

        // Pasar las pistas a la vista 'VerPistas'
        return view('InicioTrabajador.VerPistas', compact('pistas'));
    }

    // Método para crear una nueva pista
    public function createPista(Request $request)
    {
        // Validar que el número de pista no exista previamente en la base de datos
        $request->validate([
            'numero' => [
                'required',
                'numeric',
                Rule::unique('pistas', 'numeroPista'), // Regla de validación de unicidad
            ],
        ]);

        // Crear la pista en la base de datos si la validación es exitosa
        Pista::create([
            'numeroPista' => $request->input('numero'),
        ]);

        // Redirigir a la página de inicio del trabajador después de crear la pista
        return redirect()->route('InicioTrabajador.InicioTrabajador');
    }
}
