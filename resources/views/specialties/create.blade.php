@extends('layout')

@section('title', $title)

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="name" id="name" value="{{ old('name', $specialty->name ?? '') }}" required>
                <label for="name">Nombre</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea name="description" id="description" class="materialize-textarea">{{ old('description', $specialty->description ?? '') }}</textarea>
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
                    <input class="file-path validate" type="text" placeholder="Sube una imagen">
                </div>
            </div>
        </div>

        <button type="submit" class="btn waves-effect waves-light">{{ $buttonText }}</button>
    </form>
</div>
@endsection
