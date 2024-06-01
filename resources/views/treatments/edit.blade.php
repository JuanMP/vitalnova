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
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $treatment->title) }}" required>
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
            <div class="input-field col s12">
                <input type="number" name="cost" id="cost" value="{{ old('cost', $treatment->cost) }}">
                <label for="cost">Costo</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <select name="specialty_id" id="specialty_id" required>
                    <option value="" disabled selected>Selecciona una especialidad</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}" {{ $treatment->specialty_id == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                    @endforeach
                </select>
                <label for="specialty_id">Especialidad</label>
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
                @if ($treatment->image)
                    <img src="{{ $treatment->image }}" alt="{{ $treatment->title }}" style="width: 100px;">
                @endif
            </div>
        </div>

        <button type="submit" class="btn waves-effect waves-light">Guardar Cambios</button>
    </form>
</div>
@endsection
