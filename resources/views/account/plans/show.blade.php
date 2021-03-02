  @extends('layouts.account')



  @section('title')
    Suscribirme
  @endsection


  @section('content')
  <div class="content mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="card">
            <div class="card-body">
              <h2>{{$plan->name}}</h2>

              <h4>${{$plan->price}}</h4>
              <div class="row">
                <div class="col-12 text-center mb-4">
                  <h1>Suscribirme al plan</h1>
                  <p>Ingresa los datos de tu tarjeta para continuar con el pago</p>
                </div>
              </div>

              <form id="add-card-form" class="card">
                <div data-capture-name="true" class="paymentez-form card-body" data-icon-colour="#3490dc">
                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                  <input class="card-number form-control">
                  <input class="name form-control">
                  <input class="expiry-month form-control">
                  <input class="expiry-year form-control">
                </div>
                <div class="px-3 text-center">
                  <button class="btn btn-primary btn-lg">Agregar tarjeta</button>
                  <a href="{{url('/account/plans')}}" class="btn btn-outline-primary">Cancelar</a>
                </div>
                <br />
                <div id="messages"></div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  @endsection
