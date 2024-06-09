
@extends('layout')

@section('title', 'Historial de Citas')

@section('content')
<div class="container">
    <h1>Historial de Citas</h1>

    @if($appointments->isEmpty())
        <p>No tienes citas finalizadas.</p>
    @else
        <div class="row">
            @foreach($appointments as $appointment)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <h5><strong>Cita con {{ $appointment->doctor->name }}</strong></h5>
                            <span class="card-title"><strong>Fecha:</strong> {{ $appointment->date }}</span>
                            <p><strong>Hora:</strong> {{ $appointment->time }}</p>
                            <p><strong>Hora Final:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_end)->format('H:i') }}</p>
                            <p><strong>Tratamiento:</strong> {{ $appointment->treatment->title }}</p>
                            <p><strong>Observaciones:</strong> {{ $appointment->observations }}</p>
                            <a href="{{ route('generate.document', $appointment->id) }}" class="secondary-content">
                                <i class="material-icons">file_download</i>
                            </a>
                            <br>
                        </div>
                        <div class="card-action">
                            @if($appointment->status_id == 3)
                                <form action="{{ route('reviews.create', $appointment->id) }}" method="GET" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn green waves-effect waves-light">Valorar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
