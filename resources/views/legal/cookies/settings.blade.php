@extends('layout')

@section('title', 'Configuración de Cookies')

@section('content')

<div class="container">
    <h4 class="center-align">Configuración de Cookies</h4>
    <p>Última actualización: [Fecha]</p>

    <h5>1. Personalización de Cookies</h5>
    <p>Puedes personalizar tus preferencias de cookies a continuación:</p>

    <form action="#" id="cookieForm">
        <p>
            <label>
                <input type="checkbox" name="essential" checked="checked" disabled="disabled" />
                <span>Cookies Esenciales (requerido)</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="performance" checked="checked" />
                <span>Cookies de Rendimiento</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="functionality" checked="checked" />
                <span>Cookies de Funcionalidad</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="tracking" checked="checked" />
                <span>Cookies de Seguimiento</span>
            </label>
        </p>
        <button class="btn waves-effect waves-light" type="submit" name="action">Guardar Preferencias
            <i class="material-icons right">save</i>
        </button>
    </form>

    <h5>2. Cambios en la Configuración</h5>
    <p>Puedes cambiar tus preferencias de cookies en cualquier momento utilizando el formulario anterior.</p>

    <h5>3. Contacto</h5>
    <p>Si tienes alguna pregunta sobre la configuración de cookies, por favor contáctanos a través de [correo electrónico de contacto].</p>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cookieForm');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Aquí puedes agregar el código para guardar las preferencias de cookies
                M.toast({html: 'Preferencias de cookies guardadas'});
            });
        });
    </script>

@endsection
