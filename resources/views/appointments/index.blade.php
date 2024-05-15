@extends('layout')

@section('title', 'Citas')

@section('content')
<div class="container">
    <h1 class="center-align">Citas Disponibles</h1>
    <div class="row">
        <div class="col s12">
            <!-- Aquí mostrar visualmente las citas disponibles, con calendario o tabla ? -->
            <table class="striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->hour }}</td>
                            <td>{{ $appointment->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <!-- Botón para redirigir a la página de creación de citas -->
            <a class="btn waves-effect waves-light" href="{{ route('appointments.create') }}">Pedir Cita</a>
        </div>
    </div>
</div>
@endsection
