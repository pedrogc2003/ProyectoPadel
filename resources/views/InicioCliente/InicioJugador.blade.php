@extends('layout')

@section('bontones')
    <a href="{{route('InicioCliente.AnadirRerserva')}}" class="btn">Añadir Reserva</a>
    <a href="{{route('InicioCliente.VerRerservas')}}" class="btn">Ver Mis Pistas</a>
    <a href="{{route('perfil.edit') }}" class="btn">Editar Perfil</a>
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
