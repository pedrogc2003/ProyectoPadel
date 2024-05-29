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

        <!-- Verificar si hay reservas -->
        @if($reservas->isEmpty())
            <p class="tarjeta-reserva">No tienes reservas todavía.</p>
        @else
            <!-- Tarjetas de Reserva -->
            <div class="reservas-container">
                @foreach ($reservas as $reserva)
                    <div class="tarjeta-reserva">
                        <p><strong>Fecha de Reserva:</strong> {{ $reserva->dia }}</p>
                        <p><strong>Pista:</strong> Pista {{ $reserva->id_pista }}</p>
                        <p><strong>Hora:</strong> {{ $reserva->hora }}</p>

                        <div class="opciones-reserva">
                            @php
                                $fechaReserva = new DateTime($reserva->dia);
                                $fechaHoy = new DateTime();
                            @endphp

                            @if ($fechaReserva < $fechaHoy)
                                <!-- La fecha de la reserva es menor que la fecha actual, ocultar botones -->
                                <p>Reserva pasada, no se puede editar ni eliminar.</p>
                            @else
                                <!-- Mostrar botones de editar y eliminar -->
                                <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
