@extends('layout')

@section('title', 'Citas')

@section('content')
<div class="container">
    <h1>Citas</h1>
    <div class="row">
        @if(Auth::user()->hasRol('user'))
            <div class="col s12">
                <a href="{{ route('appointments.create') }}" class="btn waves-effect waves-light green">Nueva Cita</a>
            </div>
        @endif
    </div>

    @if(Auth::user()->hasRol('user'))
        <h2>Mis Citas</h2>
        @if($appointments->isEmpty())
            <p>No tienes citas programadas.</p>
        @else
            <div class="row">
                @foreach($appointments as $appointment)
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content">
                                <h5><strong>Cita con {{ $appointment->doctor->name }}</strong></h5>
                                <span class="card-title"><strong>Fecha:</strong> {{ $appointment->date }}</span>
                                <p><strong>Hora:</strong> {{ $appointment->time }}</p>
                                <p><strong>Observaciones:</strong> {{ $appointment->observations }}</p>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn blue waves-effect waves-light">Editar</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn red waves-effect waves-light">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @elseif(Auth::user()->hasRol('receptionist'))
        <div id="calendar"></div>
    @else
        <h2>Todas las Citas</h2>
        @if($appointments->isEmpty())
            <p>No tienes citas programadas.</p>
        @else
            <div class="row">
                @foreach($appointments as $appointment)
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content">
                                <h5><strong>Cita para {{ $appointment->treatment->title }}</strong></h5>
                                <span class="card-title"><strong>Fecha: </strong> {{ $appointment->date }}</span>
                                <p><strong>Hora: </strong> {{ $appointment->time }}</p>
                                <p><strong>Email: </strong> {{ $appointment->email }}</p>
                                <p><strong>Teléfono: </strong> {{ $appointment->telephone }}</p>
                                @if (Auth::user()->isDoctor())
                                    <p><strong>Paciente: </strong> {{ $appointment->user->name }}</p>
                                @else
                                    <p><strong>Doctor: </strong> {{ $appointment->doctor->name }}</p>
                                @endif
                                <p><strong>Observaciones: </strong> {{ $appointment->observations }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

@if(Auth::user()->hasRol('receptionist'))
<script>
    $(document).ready(function() {
        var appointments = @json($appointments);

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
                                            $.post(`/appointments/${event.extendedProps.id}`, {
                                                _method: 'DELETE',
                                                _token: '{{ csrf_token() }}'
                                            }, function() {
                                                swal("¡Cita eliminada!", {
                                                    icon: "success",
                                                }).then(() => {
                                                    window.location.reload();
                                                });
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
</script>
@endif

@endsection
