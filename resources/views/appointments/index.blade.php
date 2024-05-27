@extends('layout')

@section('title', 'Citas')

@section('content')
<div class="container">
    <h1>Citas</h1>
    <div class="row">
        @if(Auth::user()->hasRol('user'))
            <div class="col s12">
                <a href="{{ route('appointments.create') }}" class="btn waves-effect waves-light green">Nueva Cita</a>
            </div>
        @endif
    </div>

    @if(Auth::user()->hasRol('user'))
        <h2>Mis Citas</h2>
        @if($appointments->isEmpty())
            <p>No tienes citas programadas.</p>
        @else
            <div class="row">
                @foreach($appointments as $appointment)
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content">
                                <h5><strong>Cita con {{ $appointment->doctor->name }}</strong></h5>
                                <span class="card-title"><strong>Fecha:</strong> {{ $appointment->date }}</span>
                                <p><strong>Hora:</strong> {{ $appointment->time }}</p>
                                <p><strong>Observaciones:</strong> {{ $appointment->comentario }}</p>
                            </div>
                            <div class="card-action">
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn red waves-effect waves-light">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <h2>Todas las Citas</h2>
        @if($appointments->isEmpty())
            <p>No hay citas programadas.</p>
        @else
            <table class="striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Especialista</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ ucfirst($appointment->specialist) }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->telephone }}</td>
                            <td>{{ $appointment->comentario }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
