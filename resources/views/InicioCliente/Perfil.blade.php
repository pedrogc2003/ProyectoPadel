@extends('layout')

@section('bontones')
    <a href="{{route('InicioCliente.InicioJugador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioCliente.AnadirRerserva')}}" class="btn">Añadir Reserva</a>
    <a href="{{route('InicioCliente.VerRerservas')}}" class="btn">Ver Mis Pistas</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>

@endsection

@section('informacion')
    <div class="informacion-container">
        <h2>Mi Perfil</h2>

        <!-- Edit Perfil Form -->
        <form action="{{ route('perfil.update', Auth::user()->id) }}" method="post">
            @csrf
            @method('PUT')  
            <label for="name">Nombre:</label>
            <input type="text" name="name" value="{{ Auth::user()->nombre }}" required>

            <!-- Apellidos input -->
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" value="{{ Auth::user()->apellidos }}" required>


            <!-- Submit button -->
            <button type="submit">Modificar Perfil</button>
        </form>
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif