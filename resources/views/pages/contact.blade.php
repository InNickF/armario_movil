@extends('layouts.contact')


@section('content')

<div class="content-login">
  <div class="container-fluid p-0">

    <div class="container mt-5 justify-content-center">

      <div class="col-12 pt-0 pt-md-3 pt-lg-0 mx-auto">
        <form action="{{url('form_request')}}" class="" method="POST">
          @csrf

          <div class="login-card card d-block mx-auto p-2 mt-5">
            <div class="card-body p-0 shadow-lg">
              <div class="container px-5">
                <div class="row">
                  <div class="col-12 mt-5">
                    <div class="h3 text-center">Formulario de atención al cliente</div>
                    <div class="text-sm text-center"><small>Con este formulario puedes escribirnos sobre cualquier
                        consulta, inquietud o problema que tengas y con gusto te atenderemos</small></div>

                    <div class="form-group mt-4">
                      <div class="d-flex">
                        <label>Nombre</label>
                        <div class="text-sm ml-1"><small>*</small></div>
                      </div>
                      <input type="text" name="first_name" id="" class="form-control text-white" placeholder="" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group mt-1">
                      <div class="d-flex">
                        <label>Apellido</label>
                        <div class="text-sm ml-1"><small>*</small></div>
                      </div>
                      <input type="text" name="last_name" id="" class="form-control text-white" placeholder="" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group mt-1">
                      <div class="d-flex">
                        <label>Teléfono</label>
                        <div class="text-sm ml-1"><small>*</small></div>
                      </div>
                      <input type="text" name="phone" id="" class="form-control text-white" placeholder="" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group mt-1">
                      <div class="d-flex">
                        <label>Email</label>
                        <div class="text-sm ml-1"><small>*</small></div>
                      </div>
                      <input type="email" name="email" id="" class="form-control text-white" placeholder="" aria-describedby="helpId" required>
                    </div>


                    <div class="form-group select2-transparent w-100 v-select-dark">
                      <label for="subject">Motivo del mensaje</label>
                      <select-input class="w-100" field-name="subject" :options="['Envíos', 'Devoluciones', 'Mi tienda', 'Soporte técnico', 'Servicio al cliente', 'Otro']"></select-input>

                    </div>


                    <div class="form-group mt-1 mb-4">
                      <div class="d-flex">
                        <label>Mensaje</label>
                        <div class="text-sm ml-1"><small>*</small></div>
                      </div>
                      <textarea rows="3" class="form-control text-white" placeholder="" name="message" required></textarea>
                    </div>

                    <input name="origin" type="hidden" class="form-control" value="Formulario de contacto">
                    <button type="submit" class="btn btn-white col-lg-12 mb-5">Enviar mensaje</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
