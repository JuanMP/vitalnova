@extends('layout')

@section('title', 'Contacto')

@section('content')
<section class="section">
  <div class="container-fluid">
    <h2 class="center-align">Contacto</h2>
    <div class="row">
      <div class="col s12 m8">
        <h5>Ubicación</h5>
        <div class="card">
          <div class="card-content">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6160.881208341625!2d-0.35400821730391846!3d39.459373840163714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6048ee889b5ce3%3A0x5bac0dd44afbb1fb!2sAv.%20de%2Francia%2022%2C%20Camins%20al%20Grau%2C%2046023%20Valencia!5e0!3m2!1ses!2ses!4v1716240839515!5m2!1ses!2ses"
              width="100%"
              height="600"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
      <div class="col s12 m4">
        <h5>Información de Contacto</h5>
        <div class="card">
          <div class="card-content">
            <h6>Teléfonos</h6>
            <p>961432236</p>
            <p>722718349</p>
            <h6>Redes Sociales</h6>
            <p>
              <a href="https://facebook.com"></i></a>
              <a href="https://instagram.com"></i></a>
              <a href="https://tiktok.com"></i></a>
            </p>
          </div>
        </div>
        <h5>Horario</h5>
        <div class="card">
          <div class="card-content">
            <table>
              <thead>
                <tr>
                  <th>Día</th>
                  <th>Horario</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Lunes</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Martes</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Miércoles</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Jueves</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Viernes</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Sábado</td>
                  <td>9:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Domingo</td>
                  <td>Cerrado</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
