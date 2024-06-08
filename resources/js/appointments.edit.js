$(document).ready(function() {
    var appointments = JSON.parse(document.getElementById('appointmentsData').dataset.appointments);
    var currentTreatmentId = document.getElementById('appointmentTreatmentId').value;

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
                        title: app.time,  //Mostrar la hora en el calendario
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
