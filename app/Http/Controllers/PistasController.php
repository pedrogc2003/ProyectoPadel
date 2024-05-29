<?php

namespace App\Http\Controllers;

use App\Models\Pista; // Importa el modelo de Pista
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        // Validar el formulario
        $validator = Validator::make($request->all(), [
            'numero' => [
                'required',
                'numeric',
                Rule::unique('pistas', 'numeroPista'),
            ],
        ], [
            'numero.unique' => 'El número de pista ingresado ya existe en la base de datos.',
        ]);
    
        // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->route('InicioTrabajador.AnadirPista')->withErrors($validator)->withInput();
        }
    
        // Crear la pista si la validación es exitosa
        Pista::create([
            'numeroPista' => $request->input('numero'),
        ]);
    
        // Redirigir con mensaje de éxito
        return redirect()->route('InicioTrabajador.InicioTrabajador')->with('success', 'Pista creada satisfactoriamente.');
    }

    // Método para mostrar el formulario de reparación de una pista específica
    public function mostrarFormularioReparacion(Pista $pista)
    {
        return view('InicioTrabajador.ReparacionPista', compact('pista'));
    }

    // Método para procesar la reparación de una pista
    public function repararPista(Request $request, Pista $pista)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        // Si la validación falla, redirigir con errores
        if ($validator->fails()) {
            return redirect()->route('pista.mostrarFormularioReparacion', $pista->id)
                            ->withErrors(['error' => 'La fecha de inicio no puede ser anterior a hoy y la fecha de fin no puede ser anterior a la de inicio.'])
                            ->withInput();
        }

        // Eliminar las reservas en el plazo insertado para la pista seleccionada
        $reservas = Reserva::where('id_pista', $pista->id)
                        ->whereBetween('dia', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                        ->get();

        foreach ($reservas as $reserva) {
            $reserva->delete();
        }

        // Guardar los datos en la tabla pivote
        $pista->users()->attach(auth()->id(), [
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
        ]);

        // Redirigir a la página de inicio del trabajador con mensaje de éxito
        return redirect()->route('InicioTrabajador.InicioTrabajador')->with('success', 'Reparación de pista programada satisfactoriamente y reservas conflictivas eliminadas.');
    }
}
