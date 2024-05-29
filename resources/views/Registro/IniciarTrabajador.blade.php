@extends('layout')

@section('bontones')
    <a href="{{ route('Registro.index') }}" class="btn">Inicio</a>
    <a href="{{ route('Registro.RegistroJugador') }}" class="btn">Registrar Jugador</a>
    <a href="{{ route('Registro.IniciarJugador') }}" class="btn">Iniciar Sesión</a>
@endsection


@section('informacion')
    <div class="registro-container">
        <h2>Iniciar Sesión</h2>
        <form action="" method="post">
            @csrf
            <!-- Campos para iniciar sesión -->
            <label for="email_login">Correo Electrónico:</label>
            <input type="email" name="email_login" required>

            <label for="password_login">Contraseña:</label>
            <input type="password" name="password_login" required>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <br>       
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                       {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
