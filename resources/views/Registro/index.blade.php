@extends('layout')



@section('bontones')
    <a href="{{route('Registro.IniciarJugador')}}"  class="btn">Iniciar Sesión</a>
    <a href="{{route('Registro.RegistroJugador')}}" class="btn">Registrarse</a>
@endsection


@section('informacion')
    <div class="informacion-container">
        <h2>¡Bienvenidos al Panda Club Padel!</h2>
        <p>Aquí podrás encontrar un lugar para poder divertirte y pasar el tiempo con amigos y personas que le apasionan el mismo deporte que a tí.</p>
        <p>Estamos situados en, Polígono los Santos nº 14 en Lucena(Córdoba)</p>
        <img src="{{ asset('imagenes/5.jpg') }}" alt="Imagen club">
    </div>
@endsection