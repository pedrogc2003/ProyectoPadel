@extends('layout')

@section('bontones')
    <a href="{{ route('Registro.index') }}" class="btn">Inicio</a>
    <a href="{{ route('Registro.IniciarJugador') }}" class="btn">Iniciar Sesión</a>
@endsection

@section('informacion')
    <div class="registro-container">
        <h2>Registro de Jugador</h2>
        <form action="{{route('Registro.create')}}" method="POST">
            @csrf
            <!-- Aquí agregar campos del formulario según tus necesidades -->
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="apellido">Apellidos:</label>
            <input type="text" name="apellido" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <label for="rol">Tipo:</label>
            <input type="text" name="rol" value="Cliente" readonly required>

            <button type="submit">Registrar</button>
        </form>
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif