@extends('layout')

@section('title', 'Crear Cita')

@section('content')

<div class="container">
    <h1>Reserva de Cita</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="input-field col s12">
            <label for="treatment">Elige el tratamiento</label>
        </div>
        <div class="input-field col s12 center-align">
            @foreach($treatments as $treatment)
                <button class="btn treatment-btn" data-treatment-id="{{ $treatment->id }}" data-available="{{ $doctorsAvailable[$treatment->id] }}">{{ $treatment->title }}</button>
            @endforeach
        </div>
    </div>

    <div id='calendar'></div>

    <div id="bookingModal">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="date" id="appointmentDate">
            <input type="hidden" name="time" id="appointmentTime">
            <input type="hidden" name="treatment_id" id="appointmentTreatmentId">
            <input type="hidden" name="user_id" value="{{ request()->get('user_id', Auth::id()) }}">

            <label for="time">Selecciona la hora:</label>
            <div class="time-slots"></div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div>
                <label for="telephone">Telephone:</label>
                <input type="text" name="telephone" id="telephone" value="{{ Auth::user()->telephone }}" readonly>
            </div>
            <div>
                <label for="observations">observations:</label>
                <textarea name="observations" id="observations"></textarea>
            </div>
            <button type="submit" id="bookAppointmentBtn" disabled>Confirmar Cita</button>
            <button type="button" onclick="document.getElementById('bookingModal').style.display='none'">Cancelar</button>
        </form>
    </div>
</div>

<script id="appointmentsData" data-appointments='@json($appointments)'></script>
@vite(['resources/js/appointments.create.js','resources/css/appointments.create.css'])

@endsection
