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

    <!-- BOTONES PARA ELEGIR TRATAMIENTO -->
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

<script>
    $(document).ready(function() {
        var appointments = @json($appointments);
        var currentTreatmentId = "{{ $appointment->treatment_id }}";

        function renderCalendar(treatmentId = null) {
            var filteredAppointments = treatmentId
                ? appointments.filter(function(app) { return app.treatment_id === treatmentId; })
                : [];

            $('#calendar').fullCalendar('destroy'); //Destruye la instancia del calendario

            $('#calendar').fullCalendar({
                locale: 'es',
                events: function(start, end, timezone, callback) {
                    var events = filteredAppointments.map(function(app) {
                        return {
                            start: app.date + 'T' + app.time,
                            color: 'red',
                        };
                    });
                    callback(events);
                },
                dayClick: function(date, jsEvent, view) {
                    if (!currentTreatmentId) {
                        swal("Upss...", "Por favor, seleccione un tratamiento", "error");
                        return;
                    }

                    var today = moment().startOf('day');
                    var selectedDate = date.startOf('day');

                    if (date.day() === 0) {
                        swal("ohh...", "Lo siento, no se pueden reservar citas los domingos", "error");
                        return;
                    }

                    if (selectedDate.isBefore(today)) {
                        swal("ohh...", "Lo siento, no se pueden reservar citas en días anteriores", "error");
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
                    $('#appointmentTreatmentId').val(currentTreatmentId); //Hace un set del tratamiento seleccionado
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
            swal("Cita actualizada!", "Cita actualizada con éxito!", "success")
            .then((value) => {
                $('#bookingModal').hide();
            });
        });

        $('.treatment-btn').click(function() {
            var selectedTreatmentId = $(this).data('treatment-id');

            if (currentTreatmentId === selectedTreatmentId) {
                //Si el mismo tratamiento está seleccionado, oculta las citas
                currentTreatmentId = null;
                $('.treatment-btn').removeClass('selected');
                renderCalendar();
            } else {
                //Muestra las citas del tratamiento seleccionado
                currentTreatmentId = selectedTreatmentId;
                $('.treatment-btn').removeClass('selected');
                $(this).addClass('selected');
                renderCalendar(selectedTreatmentId);
            }
        });

        //Renderiza el calendario vacío al cargar la página
        renderCalendar(currentTreatmentId);
    });
</script>

<!-- No funciona el Js en otra carpeta ni con DOM -->
@vite(['resources/js/appointments.edit.js','resources/css/appointments.css'])


@endsection
