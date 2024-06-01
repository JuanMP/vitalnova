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
                                <p><strong>Observaciones:</strong> {{ $appointment->observations }}</p>
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
        <p>No tienes citas programadas.</p>
    @else
        <div class="row">
            @foreach($appointments as $appointment)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <h5><strong>Cita para {{ $appointment->treatment->title }}</strong></h5>
                            <span class="card-title"><strong>Fecha:</strong> {{ $appointment->date }}</span>
                            <p><strong>Hora:</strong> {{ $appointment->time }}</p>
                            <p><strong>Email:</strong> {{ $appointment->email }}</p>
                            <p><strong>Teléfono:</strong> {{ $appointment->telephone }}</p>
                            @if (Auth::user()->isDoctor())
                                <p><strong>Paciente:</strong> {{ $appointment->user->name }}</p>
                            @else
                                <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
                            @endif
                            <p><strong>observations:</strong> {{ $appointment->observations }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @endif
</div>
@endsection
