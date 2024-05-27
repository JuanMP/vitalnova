@extends('layout')

@section('title', 'Editar Tratamiento')

@section('content')
<div class="container">
    <h1>Editar Tratamiento</h1>
    <form action="{{ route('treatments.update', $treatment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $treatment->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $treatment->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($treatment->image)
                <img src="{{ $treatment->image }}" alt="{{ $treatment->title }}" style="width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
