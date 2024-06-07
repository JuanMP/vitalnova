$(document).ready(function() {
    function renderCalendar() {
        $('#calendar').fullCalendar('destroy');

        $('#calendar').fullCalendar({
            locale: 'es',
            events: appointments.map(function(app) {
                return {
                    title: app.user.name,
                    start: app.date + 'T' + app.time,
                    color: 'red',
                    extendedProps: {
                        id: app.id,
                        email: app.user.email,
                        telephone: app.user.telephone,
                        observations: app.observations || '',
                        doctorName: app.doctor.name,
                        doctorEmail: app.doctor.email,
                        doctorTelephone: app.doctor.telephone,
                        treatment: app.treatment.title,
                        userName: app.user.name,
                        userEmail: app.user.email,
                        userTelephone: app.user.telephone
                    }
                };
            }),
            eventClick: function(event, jsEvent, view) {
                if (event.extendedProps) {
                    var observations = event.extendedProps.observations ? event.extendedProps.observations : '';
                    var content = document.createElement('div');
                    content.innerHTML = `
                        <p><strong>Paciente:</strong> ${event.extendedProps.userName}</p>
                        <p><strong>Email del Paciente:</strong> ${event.extendedProps.userEmail}</p>
                        <p><strong>Teléfono del Paciente:</strong> ${event.extendedProps.userTelephone}</p>
                        <p><strong>Tratamiento:</strong> ${event.extendedProps.treatment}</p>
                        <p><strong>Doctor:</strong> ${event.extendedProps.doctorName}</p>
                        <p><strong>Email del Doctor:</strong> ${event.extendedProps.doctorEmail}</p>
                        <p><strong>Teléfono del Doctor:</strong> ${event.extendedProps.doctorTelephone}</p>
                        <p><strong>Observaciones:</strong> ${observations}</p>
                    `;

                    swal({
                        title: "Detalle de la cita",
                        content: content,
                        buttons: {
                            cancel: "OK",
                            edit: {
                                text: "Editar",
                                value: "edit",
                            },
                            delete: {
                                text: "Eliminar",
                                value: "delete",
                            }
                        }
                    }).then((value) => {
                        switch (value) {
                            case "edit":
                                window.location.href = `/appointments/${event.extendedProps.id}/edit`;
                                break;
                            case "delete":
                                swal({
                                    title: "¿Estás seguro?",
                                    text: "Una vez eliminada, no podrás recuperar esta cita.",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((willDelete) => {
                                    if (willDelete) {
                                        $.ajax({
                                            url: `/appointments/${event.extendedProps.id}`,
                                            type: 'POST',
                                            data: {
                                                _method: 'DELETE',
                                                _token: $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function() {
                                                swal("¡Cita eliminada!", {
                                                    icon: "success",
                                                }).then(() => {
                                                    window.location.reload();
                                                });
                                            }
                                        });
                                    }
                                });
                                break;
                        }
                    });
                }
            }
        });
    }

    renderCalendar();
});
