<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Pista;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservasController extends Controller
{
    // Método para mostrar el formulario de añadir reserva con la lista de pistas
    public function insertaReserva(Request $request)
    {
        // Obtener todas las pistas desde la base de datos
        $pistas = Pista::all();

        // Mostrar la vista de añadir reserva con la lista de pistas
        return view('InicioCliente.AnadirReserva', [
            'pistas' => $pistas,
        ]);
    }

    // Método para guardar una nueva reserva
    public function guardarReserva(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Validar si ya existe una reserva con la misma fecha, hora y pista
        $reservaExistente = Reserva::where([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_pista' => $request->input('pista'),
        ])->first();

        // Si ya existe, redirigir con un mensaje de error
        if ($reservaExistente) {
            return redirect()->route('InicioCliente.AnadirRerserva')->withErrors(['error' => 'Ya existe una reserva para esa fecha, hora y pista.']);
        }

        // Si no existe, crear la nueva reserva
        Reserva::create([
            'dia'=> $request->input('fecha'),
            'hora'=> $request->input('hora'),
            'id_user' => $user->id,
            'id_pista' => $request->input('pista'),
        ]);

        // Redirigir a la página de añadir reserva
        return redirect()->route('InicioCliente.AnadirRerserva');
    }

    // Método para mostrar las reservas del usuario autenticado
    public function verReserva()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener las reservas del usuario autenticado
        $reservas = Reserva::where('id_user', $user->id)->get();

        // Mostrar la vista de ver reservas con la lista de reservas
        return view('InicioCliente.VerReservas', [
            'reservas' => $reservas,
        ]);
    }

    // Método para eliminar una reserva
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        // Redirigir a la página de ver reservas
        return redirect()->route('InicioCliente.VerRerservas');
    }

    // Método para mostrar el formulario de editar reserva con la lista de pistas
    public function edit(Reserva $reserva)
    {
        // Obtener todas las pistas desde la base de datos
        $pistas = Pista::all();

        // Mostrar el formulario de editar reserva con la reserva y la lista de pistas
        return view('InicioCliente.EditarReserva', [
            'reserva' => $reserva,
            'pistas' => $pistas
        ]);
    }
    
    // Método para actualizar una reserva existente
    public function update(Request $request, Reserva $reserva)
    {
        $reserva->update([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_pista' => $request->input('pista'),
        ]);

        // Redirigir a la página de ver reservas
        return redirect()->route('InicioCliente.VerRerservas');
    }

}
