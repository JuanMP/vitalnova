@extends('layout')

@section('title', 'Crear Tratamiento')

@section('content')
<div class="container">
    <h1>Crear Nuevo Tratamiento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('treatments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                <label for="title">Nombre del Tratamiento</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="description" id="description" class="materialize-textarea" required>{{ old('description') }}</textarea>
                <label for="description">Descripción</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="number" name="cost" id="cost" value="{{ old('cost') }}">
                <label for="cost">Costo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="specialty_id" id="specialty_id" required>
                    <option value="" disabled selected>Selecciona una especialidad</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
                <label for="specialty_id">Especialidad</label>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Imagen</span>
                    <input type="file" name="image" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light">Guardar Tratamiento</button>
    </form>
</div>
@endsection
