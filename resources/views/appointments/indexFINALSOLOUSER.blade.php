<!-- HASTA ROL SOLO DE USUARIO, EL NUEVO MUESTRA CITAS DEPENDE DE SI ERES USER O DOCTOR Y RECEPTIONIST -->
<!-- @extends('layout')

@section('title', 'Mis Citas')

@section('content')
<div class="container">
    <h1>Mis Citas</h1>
    <div class="row">
        <div class="col s12">
            <a href="{{ route('appointments.create') }}" class="btn waves-effect waves-light green">Nueva Cita</a>
        </div>
    </div>
    @if($appointments->isEmpty())
        <p>No tienes citas programadas.</p>
    @else
        <div class="row">
            @foreach($appointments as $appointment)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <h5><strong>Cita con {{ $appointment->specialist }}</strong></h5>
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
</div>
@endsection -->