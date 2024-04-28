@extends('layout')

@section('title', 'Perfil')

@section('content')

<h3>Página de Perfil</h3>

<p>Nombre: {{ $user->name }}</p>



@endsection
