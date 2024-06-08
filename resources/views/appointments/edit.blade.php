@extends('layout')

@section('title', 'Editar Cita')

@section('content')

<div class="container">
    <h1>Editar Cita</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="input-field col s12">
            <label for="treatment">Elige el tratamiento</label>
        </div>
        <div class="input-field col s12 center-align">
            @foreach($treatments as $treatment)
                <button class="btn treatment-btn" data-treatment-id="{{ $treatment->id }}">{{ $treatment->title }}</button>
            @endforeach
        </div>
    </div>

    <div id='calendar'></div>

    <div id="bookingModal">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="date" id="appointmentDate" value="{{ old('date', $appointment->date) }}">
            <input type="hidden" name="time" id="appointmentTime" value="{{ old('time', $appointment->time) }}">
            <input type="hidden" name="treatment_id" id="appointmentTreatmentId" value="{{ $appointment->treatment_id }}">
            <input type="hidden" name="user_id" value="{{ $appointment->user_id }}">

            <label for="time">Selecciona la hora:</label>
            <div class="time-slots"></div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $appointment->email }}" readonly>
            </div>
            <div>
                <label for="telephone">Telephone:</label>
                <input type="text" name="telephone" id="telephone" value="{{ $appointment->telephone }}" readonly>
            </div>
            <div>
                <label for="observations">observations:</label>
                <textarea name="observations" id="observations">{{ old('observations', $appointment->observations) }}</textarea>
            </div>
            <button type="submit" id="bookAppointmentBtn" disabled>Actualizar Cita</button>
            <button type="button" onclick="document.getElementById('bookingModal').style.display='none'">Cancelar</button>
        </form>
    </div>
</div>

<script id="appointmentsData" data-appointments='@json($appointments)'></script>
@vite(['resources/js/appointments.edit.js','resources/css/appointments.edit.css'])

@endsection
