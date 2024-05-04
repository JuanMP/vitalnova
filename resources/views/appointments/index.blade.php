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
                    <input id="name" type="text" class="validate" name="name">
                    <label for="name">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email">
                    <label for="email">Correo Electrónico</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="telephone" type="text" class="validate" name="telephone">
                    <label for="telephone">Teléfono</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="date" type="date" class="datepicker" name="date">
                    <label for="date">Fecha de la cita</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="hour" type="time" class="timepicker" name="hour">
                    <label for="hour">Hora de la cita</label>
                </div>
            </div>
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


@endsection
