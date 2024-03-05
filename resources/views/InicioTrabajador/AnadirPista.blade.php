@extends('layout')

@section('bontones')
    <a href="{{route('InicioTrabajador.InicioTrabajador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioTrabajador.VerPistas')}}" class="btn">Ver Pistas</a>
    <a href="{{route('InicioTrabajador.InsertaTrabajador')}}" class="btn">Insertar Trabajador</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="informacion-container">
        <h3>Inserta Nueva Pista</h3>
        <!-- Formulario para insertar una pista por el trabajador -->
        <form action="{{route('InicioTrabajador.createPista')}}" method="post">
            @csrf
            <!-- Campos para el formulario de inserción de pista -->
            <label for="numero">Número de Pista:</label>
            <input type="number" name="numero" min="1" required>

            <button type="submit">Insertar Pista</button>
        </form>
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif