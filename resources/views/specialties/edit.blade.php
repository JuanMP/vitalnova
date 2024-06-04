@extends('layout')

@section('title', 'Editar Especialidad')

@section('content')
<div class="container">
    <h1>Editar Especialidad</h1>
    <form action="{{ route('specialties.update', $specialty->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nombre de la Especialidad:</label>
            <input type="text" name="name" id="name" value="{{ $specialty->name }}" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
