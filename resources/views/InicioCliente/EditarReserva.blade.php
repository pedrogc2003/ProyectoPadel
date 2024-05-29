@extends('layout')

@section('bontones')
    <a href="{{route('InicioCliente.InicioJugador')}}" class="btn">Página Principal</a>
    <a href="{{route('InicioCliente.VerRerservas')}}" class="btn">Ver Reservas</a>
    <a href="{{ route('perfil.edit') }}" class="btn">Editar Perfil</a>
    <a href="{{ route('Registro.index') }}" class="btn">Cerrar Sesión</a>
@endsection

@section('informacion')
    <div class="informacion-container">
        <h3>Modificar Reserva</h3>
        <form action="{{ route('reservas.update', $reserva->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="fecha">Fecha de reserva:</label>
            <input type="date" name="fecha" value="{{ $reserva->dia }}" required>

            <label for="hora">Hora de reserva:</label>
            <select name="hora" required>
                <option value="9:00" {{ $reserva->hora == '9:00' ? 'selected' : '' }}>9:00</option>
                <option value="10:30" {{ $reserva->hora == '10:30' ? 'selected' : '' }}>10:30</option>
                <option value="12:00" {{ $reserva->hora == '12:00' ? 'selected' : '' }}>12:00</option>
                <option value="13:30" {{ $reserva->hora == '13:30' ? 'selected' : '' }}>13:30</option>
                <option value="17:00" {{ $reserva->hora == '17:00' ? 'selected' : '' }}>17:00</option>
                <option value="18:00" {{ $reserva->hora == '18:00' ? 'selected' : '' }}>18:00</option>
                <option value="19:30" {{ $reserva->hora == '19:30' ? 'selected' : '' }}>19:30</option>
                <option value="21:00" {{ $reserva->hora == '21:00' ? 'selected' : '' }}>21:00</option>
            </select>

            <label for="pista">Pista a reservar:</label>
            <select name="pista" required>
                @foreach ($pistas as $pista)
                    <option value="{{ $pista->id }}" {{ $reserva->id_pista == $pista->id ? 'selected' : '' }}>{{ $pista->numeroPista }}</option>
                @endforeach
            </select>

            <button type="submit">Modificar Reserva</button>
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
