<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Pista;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function insertaReservaTrabajador(Request $request)
    {
        // Obtener todas las pistas desde la base de datos
        $pistas = Pista::all();
        $user = User::where('rol','Cliente')->get();

        // Mostrar la vista de añadir reserva con la lista de pistas
        return view('InicioTrabajador.AnadirReservaTrabajador', [
            'pistas' => $pistas,
            'user' => $user,
        ]);
    }

    public function guardarReserva(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener la fecha actual y la fecha máxima permitida para reservar (7 días en el futuro)
        $fechaHoy = now();
        $fechaMaximaPermitida = $fechaHoy->copy()->addDays(7);

        // Validar la fecha de reserva
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:' . $fechaHoy->format('Y-m-d'), // La fecha debe ser igual o posterior a hoy
                'before_or_equal:' . $fechaMaximaPermitida->format('Y-m-d'), // La fecha debe ser igual o anterior a 7 días en el futuro
            ],
            'hora' => 'required',
            'pista' => 'required',
        ]);

        if ($validator->fails()) {
            // Unificar los errores del validador en un solo mensaje
            $errorMessages = $validator->errors()->all();
            return redirect()->route('InicioCliente.AnadirRerserva')->withErrors(['error' => 'No se puede hacer una reserva menor a la del dia de hoy o superior a 7 días']);
        }

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

        // Validar si la pista está en reparación en la fecha de la reserva
        $pistaEnReparacion = DB::table('pista_usuario')
            ->where('id_pista', $request->input('pista'))
            ->whereDate('fecha_inicio', '<=', $request->input('fecha'))
            ->whereDate('fecha_fin', '>=', $request->input('fecha'))
            ->exists();

        if ($pistaEnReparacion) {
            return redirect()->route('InicioCliente.AnadirRerserva')->withErrors(['error' => 'La pista está en reparación durante la fecha seleccionada.']);
        }

        // Crear la nueva reserva si la validación es exitosa
        Reserva::create([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_user' => $user->id,
            'id_pista' => $request->input('pista'),
        ]);

        // Redirigir a la página de añadir reserva con mensaje de éxito
        return redirect()->route('InicioCliente.AnadirRerserva')->with('success', 'Reserva creada satisfactoriamente.');
    }

    // Método para guardar una nueva reserva
    public function guardarReservaTrabajador(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener la fecha actual y la fecha máxima permitida para reservar (7 días en el futuro)
        $fechaHoy = now();
        $fechaMaximaPermitida = $fechaHoy->copy()->addDays(7);

        // Validar la fecha de reserva
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:' . $fechaHoy->format('Y-m-d'), // La fecha debe ser igual o posterior a hoy
                'before_or_equal:' . $fechaMaximaPermitida->format('Y-m-d'), // La fecha debe ser igual o anterior a 7 días en el futuro
            ],
            'hora' => 'required',
            'pista' => 'required',
            'cliente' => 'required',
        ]);

        if ($validator->fails()) {
            // Unificar los errores del validador en un solo mensaje
            return redirect()->route('InicioTrabajador.AnadirReservaTrabajador')->withErrors(['error' => 'No se puede hacer una reserva menor a la del día de hoy o superior a 7 días.']);
        }

        // Validar si ya existe una reserva con la misma fecha, hora y pista
        $reservaExistente = Reserva::where([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_pista' => $request->input('pista'),
        ])->first();

        // Si ya existe, redirigir con un mensaje de error
        if ($reservaExistente) {
            return redirect()->route('InicioTrabajador.AnadirReservaTrabajador')->withErrors(['error' => 'Ya existe una reserva para esa fecha, hora y pista.']);
        }

        // Validar si la pista está en reparación en la fecha de la reserva
        $pistaEnReparacion = DB::table('pista_usuario')
            ->where('id_pista', $request->input('pista'))
            ->whereDate('fecha_inicio', '<=', $request->input('fecha'))
            ->whereDate('fecha_fin', '>=', $request->input('fecha'))
            ->exists();

        if ($pistaEnReparacion) {
            return redirect()->route('InicioTrabajador.AnadirReservaTrabajador')->withErrors(['error' => 'La pista está en reparación durante la fecha seleccionada.']);
        }

        // Crear la nueva reserva si la validación es exitosa
        Reserva::create([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_user' => $request->input('cliente'),
            'id_pista' => $request->input('pista'),
        ]);

        // Redirigir a la página de añadir reserva con mensaje de éxito
        return redirect()->route('InicioTrabajador.AnadirReservaTrabajador')->with('success', 'Reserva creada satisfactoriamente.');
    }


    public function verReserva()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las reservas del usuario autenticado
        $reservas = Reserva::where('id_user', $user->id)->get();

        // Ordenar las reservas según la fecha de reserva y su relación con la fecha actual
        $reservasOrdenadas = $reservas->sortBy(function ($reserva) {
            $fechaReserva = new \DateTime($reserva->dia);
            $fechaHoy = new \DateTime();


            if ($fechaReserva < $fechaHoy) {
                // Fecha pasada, colocar al final
                return PHP_INT_MAX;
            } else {
                // Ordenar por la diferencia de días (más cercano primero)
                return $fechaReserva->diff($fechaHoy)->days;
            }
        });

        // Mostrar la vista de ver reservas con la lista de reservas ordenadas
        return view('InicioCliente.VerReservas', [
            'reservas' => $reservasOrdenadas,
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
    
    public function update(Request $request, Reserva $reserva)
    {
        // Obtener la fecha actual y la fecha máxima permitida para reservar (7 días en el futuro)
        $fechaHoy = now();
        $fechaMaximaPermitida = $fechaHoy->copy()->addDays(7);
    
        // Validar la fecha actualizada
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:' . $fechaHoy->format('Y-m-d'), // La fecha debe ser igual o posterior a hoy
                'before_or_equal:' . $fechaMaximaPermitida->format('Y-m-d'), // La fecha debe ser igual o anterior a 7 días en el futuro
            ],
            'hora' => 'required',
            'pista' => 'required',
        ]);
    
        if ($validator->fails()) {
            // Unificar los errores del validador en un solo mensaje
            $errorMessages = $validator->errors()->all();
            return redirect()->route('reservas.edit', $reserva->id)->withErrors(['error' => 'No se puede hacer una reserva menor a la del día de hoy o superior a 7 días.'])->withInput();
        }
    
        // Validar si ya existe una reserva con la misma fecha, hora y pista
        $reservaExistente = Reserva::where([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_pista' => $request->input('pista'),
        ])->first();
    
        // Si ya existe, redirigir con un mensaje de error
        if ($reservaExistente && $reservaExistente->id != $reserva->id) {
            return redirect()->route('reservas.edit', $reserva->id)->withErrors(['error' => 'Ya existe una reserva para esa fecha, hora y pista.']);
        }
    
        // Validar si la pista está en reparación en la fecha de la reserva
        $pistaEnReparacion = DB::table('pista_usuario')
            ->where('id_pista', $request->input('pista'))
            ->whereDate('fecha_inicio', '<=', $request->input('fecha'))
            ->whereDate('fecha_fin', '>=', $request->input('fecha'))
            ->exists();
    
        if ($pistaEnReparacion) {
            return redirect()->route('reservas.edit', $reserva->id)->withErrors(['error' => 'La pista está en reparación durante la fecha seleccionada.'])->withInput();
        }
    
        // Actualizar la reserva si la validación es exitosa
        $reserva->update([
            'dia' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'id_pista' => $request->input('pista'),
        ]);
    
        // Redirigir a la página de ver reservas con mensaje de éxito
        return redirect()->route('InicioCliente.VerRerservas')->with('success', 'Reserva actualizada satisfactoriamente.');
    }
    


}
