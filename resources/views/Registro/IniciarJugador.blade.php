@extends('layout')

@section('bontones')
    <a href="{{ route('Registro.index') }}" class="btn">Inicio</a>
    <a href="{{ route('Registro.RegistroJugador') }}" class="btn">Acceder Jugador</a>
@endsection


@section('informacion')
    <div class="registro-container">
        <h2>Iniciar Sesión</h2>
        <form action="{{ route('Registro.Iniciar') }}" method="post">
            @csrf
            <!-- Campos para iniciar sesión -->
            <label for="email_login">Correo Electrónico:</label>
            <input type="email" name="email" required>
        
            <label for="password_login">Contraseña:</label>
            <input type="password" name="password" required>
        
            <button type="submit">Iniciar Sesión</button>
        </form>        
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
