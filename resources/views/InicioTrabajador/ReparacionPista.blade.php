@extends('layout')

@section('bontones')
    <a href="{{ route('InicioTrabajador.InicioTrabajador') }}" class="btn">Página Principal</a>
    <a href="{{ route('InicioTrabajador.AnadirPista') }}" class="btn">Añadir Pista</a>
    <a href="{{ route('InicioTrabajador.VerPistas') }}" class="btn">Ver Pistas</a>
    <a href="{{ route('InicioTrabajador.InsertaTrabajador') }}" class="btn">Insertar Trabajador</a>
    <a href="{{ route('InicioTrabajador.AnadirReservaTrabajador') }}" class="btn">Insertar Reserva</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="informacion-container">
        <h3>Reparación de la Pista {{ $pista->numeroPista }}</h3>
        <form action="{{ route('pista.reparar', $pista->id) }}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas poner a reparación esta pista?');">
            @csrf
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" required>

            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" name="fecha_fin" required>
        
            <button type="submit">Reparar Pista</button>
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
