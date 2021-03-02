  <!-- Color System -->
  <div class="row">
    <div class="col-md-6 col mb-4">
      <div class="card bg-light-grey card-earning">
        <div class="card-body">
          <div class="mb-2">Tu ganancia activa:</div>
          <div class="text-primary font-weight-bold h1">@money($active_earning)</div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col mb-4">
      <div class="card bg-light-green card-earning text-white shadow">
        <div class="card-body">
            <div class="mb-2">Tu ganancia total:</div>
          <div class="text-white h1 font-weight-bold">@money($total_earning)</div>
        </div>
      </div>
    </div>

    <div class="col-12">
    <a href="{{url('account/stores/request_payment')}}" class="btn btn-primary btn-block"><strong>Cobrar ahora</strong></a>
      <p class="text-sm text-primary mt-2 text-center"><strong><small>Nota: </strong>Podrás generar un cobro anticipado tu dinero antes del 15 o 30 de cada mes pagando $1 de cuota por gastos
        administrativos.<small></p>
    </div>
  </div>
