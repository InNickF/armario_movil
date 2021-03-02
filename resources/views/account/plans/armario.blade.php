<div class="col-lg-4 my-3 my-lg-2 my-lg-0 mx-0 z-999 p-0">
  <div class="card bg-blue border-radius-strong px-4 py-5 no-border box-shadow-dark margin-plan-fix">
    <div class="card-body">
      <img src="{{ asset('images/plans/armario.png') }}" class="m-auto d-block img-fluid plan-img-size">
    </div>
    <div class="text-light-purple text-center font-weight-bold text-sm">
      <p class="mb-2 small font-weight-light">@money($plan->price)</p>

      <p class="mb-2 small font-weight-light">Suscripción con RUC</p>

      <p class="mb-2 small font-weight-light">Perfil comercial</p>

      <p class="mb-2 small font-weight-light">Publicación ilimitada de productos</p>

      <p class="mb-2 small font-weight-light">30 días de anuncios</p>

      <p class="mb-2 small font-weight-light">Publicación de productos outfit</p>

      <p class="mb-2 small font-weight-light">Botón de Pago</p>

      <p class="mb-2 small font-weight-light">Servicio logístico</p>

      <p class="mb-2 small font-weight-light">Calculadora de precios, impuestos y comisiones</p>

      <p class="mb-2 small font-weight-light">Códigos de descuento</p>

      <p class="mb-2 small font-weight-light">Tarifa de comisión sobre la venta de un 12%</p>

      <p class="mb-2 small font-weight-light">Certificado SSL (venta y envío seguro)</p>

    </div>

    <div id="accordion" class="mb-3 mt-2">
              
        <div class="" id="headingThree">
          <h5 class="mb-0 text-center">
            <button class="btn btn-link text-center" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <p class="text-light-purple text-center h5">+11 beneficios
                <i class="fas fa-arrow-down"></i>
              </p>
            </button>
          </h5>
        </div>
    
        <div id="collapseThree" class="collapse mt-3" aria-labelledby="headingThree" data-parent="#accordion">
          
            <div class="text-light-purple text-center font-weight-bold text-sm">
          <p class="mb-2 small font-weight-light">Posicionamiento en motores de búsqueda</p>
  
            <p class="mb-2 small font-weight-light">Historial de ventas</p>
            
            <p class="mb-2 small font-weight-light">Dashboard profesional (Visitas)</p>

            <p class="mb-2 small font-weight-light">Dashboard profesional (Ventas)</p>
  
            <p class="mb-2 small font-weight-light">Embudo de ventas</p>
            
            <p class="mb-2 small font-weight-light">Asesoría en Moda</p>

            <p class="mb-2 small font-weight-light">Asesoría en Fotografía Profesional</p>
  
            <p class="mb-2 small font-weight-light">Asesoría en Marketing</p>
            
            <p class="mb-2 small font-weight-light">Asesoría en Comercio Electrónico</p>

            <p class="mb-2 small font-weight-light">Ofertas 24 hotas (una historia por marca por día)</p>
  
            <p class="mb-2 small font-weight-light">Subastas</p>

          </div>
        </div>
      </div>




    <div class="mt-4">
      @if (auth()->user()->getPlan()->id == $plan->id)
      <div class="d-flex justify-content-center">
        <div class="btn-outline-purple px-4 rounded-lg text-center font-weight-bold mb-3 px-5">Activo</div>
      </div>

      @if (!$plan->isFree())
      <div class="text-center mb-2">
          <a class="text-light-purple" href="{{url('contacto')}}">Cancelar plan</a>
      </div>
      @endif

      <!--  Modal-->
      <div class="modal fade" id="cancelPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cancelar plan</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              @if (auth()->check() && auth()->user()->getSubscription())
              <h4>Confirma que deseas cancelar tu suscripción actual</h4>
              @else
              <p class="text-info">No tienes ninguna suscripción activa</p>
              @endif
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-primary" type="button" data-dismiss="modal">Mantener mi
                plan</button>


              <a href="#" class="btn btn-danger btn-flat"
                onclick="event.preventDefault(); document.getElementById('cancelPlanForm').submit();">
                Cancelar plan
              </a>
              <form id="cancelPlanForm" action="{{ url('account/plans/cancel') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>

            </div>
          </div>
        </div>
      </div>


      @endif

      <div class="d-flex justify-content-center">
        @if (auth()->user()->canUpgradeToPlan($plan))
        <a class="btn btn-purple btn-sm font-weight-bold h5 mb-3 px-5"
          href="{{url('account/plans/' . $plan->id . '/pay')}}">Obtener</a>
        @endif
      </div>

      <div>
        @if (!auth()->user()->store->hasRuc())
        <div class="mb-2 small font-weight-light text-light text-center">Debes tener RUC para contratar este plan. Agrégalo en 
          <a class="text-white" href="{{url('account/profile/')}}">
          <u>Mi cuenta</u></a></div>
        @endif
      </div>
    </div>

  </div>
</div>
