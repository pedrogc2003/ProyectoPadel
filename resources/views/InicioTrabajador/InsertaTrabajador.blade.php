<!-- formularioInsercionTrabajador.blade.php -->
@extends('layout')

@section('bontones')
    <a href="{{route('InicioTrabajador.InicioTrabajador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioTrabajador.AnadirPista')}}" class="btn">Añadir Pista</a>
    <a href="{{route('InicioTrabajador.VerPistas')}}" class="btn">Ver Pistas</a>
    <a href="{{route('InicioTrabajador.AnadirReservaTrabajador')}}" class="btn">Insertar Reserva</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection



@section('informacion')
    <div class="informacion-container">
        <h2>Formulario de Inserción de Trabajador</h2>
        <form action="{{route('InicioTrabajador.create')}}" method="post">
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
            <select name="rol" required>
                <option value="Cliente">Cliente</option>
                <option value="Trabajador">Trabajador</option>
            </select>



            <button type="submit">Insertar</button>
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