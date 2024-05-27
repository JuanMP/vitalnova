@extends('layout')

@section('title', 'Crear Cita')

@section('content')

<style>
    /* Estilos para el modal */
    #bookingModal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        z-index: 1000;
    }
    #bookingModal form {
        display: flex;
        flex-direction: column;
    }
    #bookingModal label, #bookingModal input, #bookingModal textarea, #bookingModal button {
        margin-bottom: 10px;
    }
    #bookingModal button[type="button"] {
        background: #ccc;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
    #bookingModal button[type="submit"] {
        background: #4CAF50;
        border: none;
        padding: 10px;
        cursor: pointer;
        color: white;
    }
    #bookingModal .time-slots {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }
    #bookingModal .time-slot {
        width: calc(20% - 10px);
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
        text-align: center;
    }
    #bookingModal .time-slot.selected {
        background-color: #4CAF50;
        color: white;
    }
    #bookingModal .time-slot.disabled {
        background-color: #eee;
        cursor: not-allowed;
    }

    /* Estilos para los botones */
    .specialist-btn {
        margin: 0 5px;
        background-color: #2196F3; /* Color azul inicial */
        color: white; /* Texto blanco */
        transition: background-color 0.3s;
    }
    .specialist-btn:hover {
        background-color: #1976D2; /* Color azul oscuro al pasar el mouse */
    }
    .specialist-btn.selected {
        background-color: #4CAF50 !important; /* Color verde cuando está seleccionado */
        color: white !important;
    }
    .doctor-btn {
        margin: 0 5px;
        background-color: #FFA726; /* Color naranja inicial */
        color: white; /* Texto blanco */
        transition: background-color 0.3s;
    }
    .doctor-btn:hover {
        background-color: #FB8C00; /* Color naranja oscuro al pasar el mouse */
    }
    .doctor-btn.selected {
        background-color: #FF5722 !important; /* Color rojo cuando está seleccionado */
        color: white !important;
    }
    .doctor-btn.disabled {
        background-color: #eee;
        color: #ccc;
        cursor: not-allowed;
    }
</style>

<div class="container">
    <h1>Reserva de Cita</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- BOTONES PARA ELEGIR ESPECIALISTA (CON DESPLEGABLE DABA PROBLEMAS) -->
    <div class="row">
        <div class="input-field col s12">
            <label for="specialist">Elige el especialista</label>
        </div>
        <div class="input-field col s12 center-align">
            <button class="btn specialist-btn" data-specialist="1">Ortodoncista</button>
            <button class="btn specialist-btn" data-specialist="2">Odontólogo</button>
            <button class="btn specialist-btn" data-specialist="3">Higienista</button>
        </div>
    </div>

    <div id='calendar'></div>

    @if(Auth::check())
        <div id="bookingModal">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="date" id="appointmentDate">
                <input type="hidden" name="time" id="appointmentTime">
                <input type="hidden" name="specialist_id" id="appointmentSpecialist">
                <input type="hidden" name="doctor_id" id="doctor_id">
                <label for="doctor_id">Elige el Doctor:</label>
                <div class="row" id="doctorsList">
                    @foreach($doctors as $doctor)
                        <div class="col">
                            <button type="button" class="btn doctor-btn" data-doctor-id="{{ $doctor->id }}" data-specialist-id="{{ $doctor->specialist_id }}">{{ $doctor->name }}</button>
                        </div>
                    @endforeach
                </div>
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
                    <label for="comentario">Comentario:</label>
                    <textarea name="comentario" id="comentario"></textarea>
                </div>
                <button type="submit" id="bookAppointmentBtn" disabled>Confirmar Cita</button>
                <button type="button" onclick="document.getElementById('bookingModal').style.display='none'">Cancelar</button>
            </form>
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {
        var appointments = @json($appointments);
        var doctors = @json($doctors);
        var currentSpecialist = null;

        function renderCalendar(specialist = null) {
            var filteredAppointments = specialist
                ? appointments.filter(function(app) { return app.specialist_id == specialist; })
                : [];

            $('#calendar').fullCalendar('destroy'); //Destruye la instancia actual del calendario

            $('#calendar').fullCalendar({
                locale: 'es',
                events: filteredAppointments.map(function(app) {
                    return {
                        title: app.email,
                        start: app.date + 'T' + app.time,
                        color: 'red'
                    };
                }),
                dayClick: function(date, jsEvent, view) {
                    if (!currentSpecialist) {
                        alert("Por favor, seleccione un especialista");
                        return;
                    }

                    var today = moment().startOf('day');
                    var selectedDate = date.startOf('day');

                    if (date.day() === 0) {
                        alert("Lo siento, no se pueden reservar citas los domingos");
                        return;
                    }

                    if (selectedDate.isBefore(today)) {
                        alert("Lo siento, no se pueden reservar citas en días anteriores");
                        return;
                    }

                    var currentTime = moment();

                    selectedDate = date.format('YYYY-MM-DD');
                    var availableTimes = [
                        '09:00', '10:00', '11:00',
                        '12:00', '13:00'
                    ];

                    var bookedTimes = filteredAppointments
                        .filter(app => app.date === selectedDate)
                        .map(app => moment(app.time, 'HH:mm:ss').format('HH:mm'));

                    var timeSlotsHtml = '';
                    availableTimes.forEach(function(time) {
                        var slotMoment = moment(selectedDate + ' ' + time, 'YYYY-MM-DD HH:mm');
                        var isBooked = bookedTimes.includes(time);
                        var isPast = selectedDate === today.format('YYYY-MM-DD') && slotMoment.isBefore(currentTime);
                        var slotClass = isBooked || isPast ? 'disabled' : '';
                        timeSlotsHtml += '<div class="time-slot ' + slotClass + '" data-time="' + time + '">' + time + '</div>';
                    });

                    $('#appointmentDate').val(selectedDate);
                    $('#appointmentSpecialist').val(currentSpecialist); //Hace set del especialista seleccionado
                    $('.time-slots').html(timeSlotsHtml);

                    $('.time-slot:not(.disabled)').on('click', function() {
                        $('.time-slot').removeClass('selected');
                        $(this).addClass('selected');
                        $('#appointmentTime').val($(this).data('time'));
                        checkFormValidity();
                    });

                    $('#bookingModal').show();
                }
            });
        }

        function checkFormValidity() {
            var selectedTime = $('#appointmentTime').val();
            var selectedDoctor = $('#doctor_id').val();
            if (selectedTime && selectedDoctor) {
                $('#bookAppointmentBtn').prop('disabled', false);
            } else {
                $('#bookAppointmentBtn').prop('disabled', true);
            }
        }

        $('.specialist-btn').on('click', function() {
            currentSpecialist = $(this).data('specialist');
            $('.specialist-btn').removeClass('selected');
            $(this).addClass('selected');
            renderCalendar(currentSpecialist);
            $('#doctor_id').val('');
            $('.doctor-btn').removeClass('selected').prop('disabled', true);
            $('.doctor-btn[data-specialist-id="' + currentSpecialist + '"]').prop('disabled', false);
        });

        $('.doctor-btn').on('click', function() {
            if (!$(this).hasClass('disabled')) {
                $('.doctor-btn').removeClass('selected');
                $(this).addClass('selected');
                $('#doctor_id').val($(this).data('doctor-id'));
                checkFormValidity();
            }
        });

        renderCalendar();
    });
</script>

@endsection
