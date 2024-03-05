@extends('layout')

@section('bontones')
    <a href="{{route('InicioCliente.InicioJugador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioCliente.VerRerservas')}}" class="btn">Ver Reservas</a>
    <a href="{{ route('perfil.edit') }}" class="btn">Editar Perfil</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="informacion-container">
        <h3>Reserva de Pistas</h3>
        <form action="{{route('InicioCliente.InsertaRerserva')}}" method="post">
            @csrf
            <label for="fecha">Fecha de reserva:</label>
            <input type="date" name="fecha" required>
        
            <label for="hora">Hora de reserva:</label>
            <select name="hora" required>
                <option value="9:00">9:00</option>
                <option value="10:30">10:30</option>
                <option value="12:00">12:00</option>
                <option value="13:30">13:30</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:30">19:30</option>
                <option value="21:00">21:00</option>
            </select>
        
            <label for="pista">Pista a reservar:</label>
            <select name="pista" required>
                @foreach ($pistas as $pista)
                    <option value="{{ $pista->numeroPista }}">{{ $pista->numeroPista }}</option>
                @endforeach
            </select>

        
            <button type="submit">Reservar Pista</button>
        </form>
        
    </div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif