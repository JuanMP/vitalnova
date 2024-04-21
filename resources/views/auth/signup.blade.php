@extends('layout')

@section('title', 'Registro')

@section('content')


@extends('layout')

@section('title', 'Registro')

@section('content')

<style>
    body {
      background-color: #f2f7ff; /* Color de fondo */
    }
    #register-container {
      max-width: 600px;
      margin: 50px auto; /* Ajusta la margen superior e inferior */
    }
    #register-container img {
      max-width: 100%;
      height: auto;
    }
    #register-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
  </style>

  <div id="register-container" class="row">
    <div class="col s12 m6">
      <img src="/img/others/login2.jpg" alt="Registro Clínica Dental">
    </div>
    <div class="col s12 m6">
      <h3 id="register-title">Registro</h3>
      <form action="{{ route('signup') }}" method="post">
        <div class="row">
          <div class="input-field col s12">
            <input id="nombre" type="text" class="validate">
            <label for="nombre">Nombre</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="validate">
            <label for="email">Correo electrónico</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="contrasena" type="password" class="validate">
            <label for="contrasena">Contraseña</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="confirmar_contrasena" type="password" class="validate">
            <label for="confirmar_contrasena">Confirmar contraseña</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Registrarse
              <i class="material-icons right">send</i>
            </button>
          </div>
          <div class="col s12">
            <p class="center-align">¿Ya tienes una cuenta? <a href="#">Iniciar sesión</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection


@endsection
