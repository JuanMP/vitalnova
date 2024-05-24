@extends('layout')

@section('title', 'Citas')

@section('content')

<style>
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
</style>

<div class="container">
    <h1>Reserva de Cita</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div>
    <label for="specialist">Elige el especialista</label>
    <select id="specialist">
        <option value="">Elige</option>
        <option value="orthodontist">Ortodoncista</option>
        <option value="dentist">Odontólogo</option>
        <option value="hygienist">Higienista</option>
    </select>
    </div>

    <div id='calendar'></div>

    <!-- Modal for booking appointment -->
    <div id="bookingModal">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="date" id="appointmentDate">
            <input type="hidden" name="time" id="appointmentTime">
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
            <button type="submit" id="bookAppointmentBtn">Confirmar Cita</button>
            <button type="button" onclick="document.getElementById('bookingModal').style.display='none'">Cancel</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var appointments = @json($appointments);

        $('#calendar').fullCalendar({
            events: appointments.map(function(app) {
            // Convertir a formato 24 horas
            var time = moment(app.time, 'HH:mm:ss').format('H[h]');
            return {
                title: app.email,
                start: app.date + 'T' + app.time,
                color: 'red'
            };
        }),
            dayClick: function(date, jsEvent, view) {
                var today = moment().startOf('day');
                var selectedDate = date.startOf('day');

                // Evitar que se pueda reservar en domingos (día 0 son domingos)
                if (date.day() === 0) {
                    alert("Lo siento, no se pueden reservar citas los domingos.");
                    return;
                }

                // Evitar que se pueda reservar en días anteriores al actual
                if (selectedDate.isBefore(today)) {
                    alert("Lo siento, no se pueden reservar citas en días anteriores.");
                    return;
                }

                var currentTime = moment();

                selectedDate = date.format('YYYY-MM-DD');
                var availableTimes = [
                    '09:00', '10:00', '11:00', 
                    '12:00', '13:00'
                ];

                var bookedTimes = appointments
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
                $('.time-slots').html(timeSlotsHtml);
                $('#bookingModal').show();
                
                // Verificar si se ha seleccionado una hora al abrir el modal
                checkSelectedTime();
            }
        });

        $(document).on('click', '.time-slot:not(.disabled)', function() {
            $('.time-slot.selected').removeClass('selected');
            $(this).addClass('selected');
            var selectedTime = $(this).data('time');
            $('#appointmentTime').val(selectedTime);
            
            // Verificar si se ha seleccionado una hora al hacer clic en una hora disponible
            checkSelectedTime();
        });

        // Función para verificar si se ha seleccionado una hora
        function checkSelectedTime() {
            var selectedTime = $('#appointmentTime').val();
            if (selectedTime) {
                $('#bookAppointmentBtn').prop('disabled', false);
            } else {
                $('#bookAppointmentBtn').prop('disabled', true);
            }
        }

        $('#bookingModal form').submit(function(event) {
            event.preventDefault();
            this.submit();
            alert("Cita creada con éxito!");
            $('#bookingModal').hide();
        });
    });
</script>

@endsection
