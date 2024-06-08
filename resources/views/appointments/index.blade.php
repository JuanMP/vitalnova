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
                                @if($appointment->status_id == 1)
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn blue waves-effect waves-light">Editar</a>
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn red waves-effect waves-light">Eliminar</button>
                                    </form>
                                @elseif($appointment->status_id == 2)
                                    <span class="grey-text">Cita en curso</span>
                                @elseif($appointment->status_id == 3)
                                    <span class="grey-text">Cita finalizada</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @elseif(Auth::user()->hasRol('receptionist'))
        <div id="calendar"></div>
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
                                <span class="card-title"><strong>Fecha: </strong> {{ $appointment->date }}</span>
                                <p><strong>Hora: </strong> {{ $appointment->time }}</p>
                                <p><strong>Email: </strong> {{ $appointment->email }}</p>
                                <p><strong>Teléfono: </strong> {{ $appointment->telephone }}</p>
                                @if (Auth::user()->isDoctor())
                                    <p><strong>Paciente: </strong> {{ $appointment->user->name }}</p>
                                    <p><strong>Observaciones: </strong> {{ $appointment->observations }}</p>
                                    @if($appointment->status_id == 1)
                                        <form action="{{ route('appointments.start', $appointment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn green waves-effect waves-light">Iniciar Cita</button>
                                        </form>
                                    @elseif($appointment->status_id == 2)
                                        <form action="{{ route('appointments.finish', $appointment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn orange waves-effect waves-light">Finalizar Cita</button>
                                        </form>
                                    @elseif($appointment->status_id == 3)

                                        <button  class="btn blue waves-effect waves-light">Cita Finalizada</button>

                                    @endif
                                @else
                                    <p><strong>Doctor: </strong> {{ $appointment->doctor->name }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

@if(Auth::user()->hasRol('receptionist'))
    <script>
        var appointments = @json($appointments);
    </script>
    @vite(['resources/js/appointments.receptionist.js','resources/css/appointments.create.css'])


@endif

@endsection
