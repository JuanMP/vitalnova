@extends('layout')

@section('title', 'Editar Tratamiento')

@section('content')
<div class="container">
    <h1>Editar Tratamiento</h1>
    <form action="{{ route('treatments.update', $treatment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="{{ old('title', $treatment->title) }}" required>
                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="description" id="description" class="materialize-textarea" required>{{ old('description', $treatment->description) }}</textarea>
                <label for="description">Descripción</label>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Imagen</span>
                    <input type="file" name="image">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        @if ($treatment->image)
            <div class="row">
                <div class="col s12">
                    <img src="{{ $treatment->image }}" alt="{{ $treatment->title }}" style="width: 100px;">
                </div>
            </div>
        @endif
        <div class="row">
            <div class="input-field col s12">
                <input type="number" name="cost" id="cost" value="{{ old('cost', $treatment->cost) }}" step="0.01" required>
                <label for="cost">Costo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="doctor_id" id="doctor_id" required>
                    <option value="" disabled selected>Seleccionar Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $treatment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }} - {{ $doctor->specialty }}
                        </option>
                    @endforeach
                </select>
                <label for="doctor_id">Doctor Responsable</label>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light">Guardar Cambios</button>
    </form>
</div>
@endsection
