@extends('layout')

@section('bontones')
    <a href="{{route('InicioCliente.InicioJugador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioCliente.AnadirRerserva')}}" class="btn">Añadir Reservas</a>
    <a href="{{ route('perfil.edit') }}" class="btn">Editar Perfil</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="informacion-container">
        <h2>Mis Reservas</h2>

        <!-- Tarjetas de Reserva -->
        <div class="reservas-container">
            @foreach ($reservas as $reserva)
                <div class="tarjeta-reserva">
                    <p><strong>Fecha de Reserva:</strong> {{ $reserva->dia }}</p>
                    <p><strong>Pista:</strong> Pista {{ $reserva->id_pista }}</p>
                    <p><strong>Pista:</strong> Hora {{ $reserva->hora }}</p>

                    <div class="opciones-reserva">
                        <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif