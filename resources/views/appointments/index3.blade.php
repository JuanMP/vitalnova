
@extends('layout')

@section('title', 'Citas')

@section('content')

<div class="container">
    <h1 class="center-align">Pedir Cita</h1>
    <div class="row">
        <form class="col s12" action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email" value="{{ $user->email }}" readonly>
                    <label for="email" class="active">Correo Electrónico</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="telephone" type="text" class="validate" name="telephone" value="{{ $user->telephone }}" readonly>
                    <label for="telephone" class="active">Teléfono</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="date" type="date" class="datepicker" name="date" value="{{ $date }}">
                    <label for="date" class="active">Fecha de la cita</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <p>Seleccione una hora:</p>
                    @foreach($availableSlots as $slot)
                        <button type="button" class="btn hour-btn {{ $slot['available'] ? 'green' : 'red' }}" 
                                data-hour="{{ $slot['time'] }}" {{ !$slot['available'] ? 'red' : '' }}>
                            {{ $slot['time'] }}
                        </button>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="hour" id="selected-hour">
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="comentario" class="materialize-textarea" name="comentario"></textarea>
                    <label for="comentario">Comentario</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Pedir Cita</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hourButtons = document.querySelectorAll('.hour-btn');
        const selectedHourInput = document.getElementById('selected-hour');

        hourButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('red')) {
                    alert('La hora seleccionada no está disponible.');
                    return;
                }
                selectedHourInput.value = this.getAttribute('data-hour');
                hourButtons.forEach(btn => btn.classList.remove('blue', 'pulse'));
                this.classList.add('blue', 'pulse');
            });
        });
    });
</script>

<script>
    button.addEventListener('click', function() {
    if (!this.classList.contains('available')) {
        alert('La hora seleccionada no está disponible.');
        return;
    }
    selectedHourInput.value = this.getAttribute('data-hour');
    hourButtons.forEach(btn => btn.classList.remove('blue', 'pulse'));
    this.classList.add('blue', 'pulse');
    //Set button color based on 'available' attribute
    this.style.backgroundColor = this.classList.contains('available') ? '#2196f3' : '#f44336';
});

</script>

<style>
    .pulse {
        animation: pulse-animation 0.5s;
    }

    @keyframes pulse-animation {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }
    .blue {
        background-color: #2196f3 !important;
    }
    .red {
        background-color: #f44336 !important;
    }
</style>



@endsection
