@extends('layout')

@section('title', 'Valorar Cita')

@section('content')
<div class="container">
    <h1>Valorar Cita con {{ $appointment->doctor->name }}</h1>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

        <div class="row">
            <div class="input-field col s12">
                <textarea name="review" id="review" class="materialize-textarea" ></textarea>
                <label for="review">Reseña</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <select name="score" id="score" >
                    <option value="" disabled selected>Elige una puntuación</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <label for="score">Puntuación</label>
            </div>
        </div>

        <button type="submit" class="btn waves-effect waves-light">Enviar Valoración</button>
    </form>
</div>
@endsection
