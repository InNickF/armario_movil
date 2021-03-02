@extends('layouts.contact')


@section('content')

<div class="content-login">
  <div class="container-fluid p-0">

    <div class="row justify-content-center">

      <div class="col-12 mx-auto">

        <div class="login-card card d-block mx-auto p-2 mt-5">
          <div class="card-body p-0 shadow-lg">
            <div class="container px-5">
              <div class="row">
                <div class="col-12 mt-5">
                  <div class="h3 text-center">Datos enviados exitosamente</div>
                  <div class="text-sm text-center mb-5"><small>Gracias por escribirnos, nuestro equipo de atención al cliente se comunicará contigo lo antes posible.</small></div>

                  <a href="{{url('/')}}" name="" id="" class="btn btn-outline-transparent-white col-lg-12 mb-5">Volver al inicio</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
