@extends('layout')

@section('bontones')
    <a href="{{route('InicioTrabajador.InicioTrabajador')}}" class="btn">Inicio</a>
    <a href="{{route('InicioTrabajador.AnadirPista')}}" class="btn">Añadir Pista</a>
    <a href="{{route('InicioTrabajador.InsertaTrabajador')}}" class="btn">Insertar Trabajador</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection



@section('informacion')
    <div class="informacion-container">
        <h2>Pistas</h2>

        <!-- Tarjetas de Reserva -->
        <div class="reservas-container">
            @foreach ($pistas as $pista)
                <div class="tarjeta-reserva">
                    <p><strong>Numero de Pista:</strong> {{ $pista->numeroPista }}</p>
                    <div class="opciones-reserva">
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