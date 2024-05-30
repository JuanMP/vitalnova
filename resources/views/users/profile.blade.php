@extends('layout')

@section('title', 'Perfil')

@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <h5 class="center-align">Página de Perfil</h5>
      <div class="card">
        <div class="card-image">
          <img src="{{ $user->image ? asset($user->image) : asset('img/others/default-profile.jpg') }}" alt="Profile Picture" class="responsive-img circle" style="width: 150px; height: 150px; margin: 20px auto;">
        </div>
        <div class="card-content">
          <span class="card-title center-align">{{ $user->name }}</span>
          <p class="center-align">{{ ucfirst($user->rol) }}</p>
          <div class="divider"></div>
          <div class="row">
            <div class="col s12 m6">
              <p><i class="material-icons prefix">email</i> <strong>Correo electrónico:</strong> {{ $user->email }}</p>
              <p><i class="material-icons prefix">assignment_ind</i> <strong>DNI:</strong> {{ $user->dni }}</p>
              <p><i class="material-icons prefix">cake</i> <strong>Fecha de nacimiento:</strong> {{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'No disponible' }}</p>
            </div>
            <div class="col s12 m6">
              <p><i class="material-icons prefix">phone</i> <strong>Teléfono:</strong> {{ $user->telephone }}</p>
            </div>
          </div>
        </div>
        <div class="card-action center-align">
          <a href="{{ route('users.edit', $user) }}" class="waves-effect waves-light btn-large">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>

  @if(count($appointments) > 0)
    <div class="row">
      <div class="col s12">
        <h5 class="center-align">Citas</h5>
        <ul class="collection">
          @foreach($appointments as $appointment)
            <li class="collection-item">
              <div>{{ $appointment->date }} - {{ $appointment->specialist }}
                <a href="{{ route('generate.document', $appointment->id) }}" class="secondary-content">
                  <i class="material-icons">file_download</i>
                </a>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
</div>

@endsection
