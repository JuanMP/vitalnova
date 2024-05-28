@extends('layout')

@section('title', 'Citas')

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
</style>

<div class="container">
    <h1>Reserva de Cita</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- DE BOTONES PARA ELEGIR ESPECIALISTA (CON DESPLEGABLE DABA PROBLEMAS) -->
    <div class="row">
        <div class="input-field col s12">
            <label for="specialist">Elige el especialista</label>
        </div>
        <div class="input-field col s12 center-align">
            <button class=" btn specialist-btn" data-specialist="orthodontist">Ortodoncista</button>
            <button class=" btn specialist-btn" data-specialist="dentist">Odontólogo</button>
            <button class=" btn specialist-btn" data-specialist="hygienist">Higienista</button>
        </div>
    </div>

    <div id='calendar'></div>

    @if(Auth::check())
        <div id="bookingModal">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="date" id="appointmentDate">
                <input type="hidden" name="time" id="appointmentTime">
                <input type="hidden" name="specialist" id="appointmentSpecialist">
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
                <button type="button" onclick="document.getElementById('bookingModal').style.display='none'">Cancel</button>
            </form>
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {
        var appointments = @json($appointments);
        var currentSpecialist = null;

        function renderCalendar(specialist = null) {
            var filteredAppointments = specialist 
                ? appointments.filter(function(app) { return app.specialist === specialist; })
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
                    $('#bookingModal').show();

                    checkSelectedTime();
                }
            });
        }

        function checkSelectedTime() {
            var selectedTime = $('#appointmentTime').val();
            if (selectedTime) {
                $('#bookAppointmentBtn').prop('disabled', false);
            } else {
                $('#bookAppointmentBtn').prop('disabled', true);
            }
        }

        $(document).on('click', '.time-slot:not(.disabled)', function() {
            $('.time-slot.selected').removeClass('selected');
            $(this).addClass('selected');
            var selectedTime = $(this).data('time');
            $('#appointmentTime').val(selectedTime);
            checkSelectedTime();
        });

        $('#bookingModal form').submit(function(event) {
            event.preventDefault();
            this.submit();
            alert("Cita creada con éxito!");
            $('#bookingModal').hide();
        });

        $('.specialist-btn').click(function() {
            var selectedSpecialist = $(this).data('specialist');

            if (currentSpecialist === selectedSpecialist) {
                //Si el mismo especialista está seleccionado, oculta las citas
                currentSpecialist = null;
                $('.specialist-btn').removeClass('selected'); //Quita la clase 'selected' de todos los botones
                renderCalendar();
            } else {
                //Muestra las citas del especialista seleccionado
                currentSpecialist = selectedSpecialist;
                $('.specialist-btn').removeClass('selected'); //Quita la clase 'selected' de todos los botones
                $(this).addClass('selected'); //Agrega la clase 'selected' al botón seleccionado
                renderCalendar(selectedSpecialist);
            }
        });

        //Renderiza el calendario vacío al cargar la página
        renderCalendar();
    });
</script>

@endsection
