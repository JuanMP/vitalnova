{{-- @extends('layout')

@section('title', 'Citas')

@section('content')
    <h1>Seleccione la fecha y hora de su cita:</h1>
    <form action="{{ route('citas.reservar') }}" method="POST">
        @csrf
        <select name="fecha_hora" required>
            @foreach($horas_disponibles as $hora_disponible)
                <option value="{{ $hora_disponible->hora }}">{{ $hora_disponible->hora }}</option>
            @endforeach
        </select>
        <button type="submit">Reservar cita</button>
    </form>
@endsection --}}
