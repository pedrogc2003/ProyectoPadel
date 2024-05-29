@extends('layout')

@section('bontones')
    <a href="{{route('InicioTrabajador.AnadirPista')}}" class="btn">Añadir Pista</a>
    <a href="{{route('InicioTrabajador.VerPistas')}}" class="btn">Ver Pistas</a>
    <a href="{{route('InicioTrabajador.InsertaTrabajador')}}" class="btn">Insertar Trabajador</a>
    <a href="{{route('InicioTrabajador.AnadirReservaTrabajador')}}" class="btn">Insertar Reserva</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="contenedor-pistas">
        @foreach($pistas as $pista)
            <div class="pista">
                <img src="{{ asset('imagenes/6.png') }}" class="pista-imagen" alt="fotografia" width="140" height="200"> 
                <h3>Pista: {{$pista->numeroPista}}</h3>
            </div>
        @endforeach
    </div>
@endsection
