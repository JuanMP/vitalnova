@extends('layout')

@section('title', 'Crear Especialidad')

@section('content')
<div class="container">
    <h1>Crear Especialidad</h1>
    <form action="{{ route('specialties.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre de la Especialidad</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
