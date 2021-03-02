<div class="col-lg-4 pr-lg-0 my-3 my-lg-5">
    <div class="card bg-transparent-blue px-4 py-4 border-radius-strong">
      <div class="card-body">
        <img src="{{ asset('images/plans/ropero.png') }}" class="m-auto d-block img-fluid plan-img-size">
      </div>
        <div class="text-light-pink text-center font-weight-bold text-sm">
          <p class="mb-2 small font-weight-light">Gratis</p>
          
          <p class="mb-2 small font-weight-light">Suscripción con cédula</p>
          
          <p class="mb-2 small font-weight-light">Suscripción con RUC</p>
          
          <p class="mb-2 small font-weight-light">Perfil comercial</p>
          
          <p class="mb-2 small font-weight-light">Publicación de 5 productos</p>

          <p class="mb-2 small font-weight-light">15 días de anuncios activos</p>

          <p class="mb-2 small font-weight-light">Bóton de pago</p>
          
          <p class="mb-2 small font-weight-light">Servicio logístico</p>

          <p class="mb-2 small font-weight-light">Calculadora de precios, impuestos y comisiones</p>

          <p class="mb-2 small font-weight-light">22% comisión sobre venta</p>
           
          </div>

          <div id="accordion" class="mb-3 mt-2">
              
                <div class="" id="headingOne">
                  <h5 class="mb-0 text-center">
                    <button class="btn btn-link text-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <p class="text-light-pink text-center h5">+4 beneficios
                        <i class="fas fa-arrow-down"></i>
                      </p>
                    </button>
                  </h5>
                </div>
            
                <div id="collapseOne" class="collapse mt-3" aria-labelledby="headingOne" data-parent="#accordion">
                  
                    <div class="text-light-pink text-center font-weight-bold text-sm">
          
                    <p class="mb-2 small font-weight-light">Certificado SSL (venta y envío seguro)</p>

                    <p class="mb-2 small font-weight-light">Posicionamiento en motores de búsqueda</p>
                    
                    <p class="mb-2 small font-weight-light">Historial de ventas</p>
                    
                    <p class="mb-2 small font-weight-light">Ofertas 24 hotas (una historia por marca por día)</p>
                  </div>
                </div>
              </div>

        <div class="my-3 pb-2">
          @if (Auth::user()->getSubscription() && Auth::user()->getPlan()->id == $plan->id)
          <div class="d-flex justify-content-center">
          <div class="btn-outline-pink btn-sm px-4 rounded-lg text-center font-weight-bold mb-3 px-5">Activo</div>
        </div>
        
        @if (!$plan->isFree())
        <div class="text-center mb-2">
            <a class="text-light-pink" href="{{url('contacto')}}">Cancelar plan</a>
        </div>
        @endif

          <!--  Modal-->
          <div class="modal fade" id="cancelPlanModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <form id="cancelPlanForm" action="{{ url('account/plans/cancel') }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                  </form>

                </div>
              </div>
            </div>
          </div>


          @endif
          @if (Auth::user()->canUpgradeToPlan($plan))
          <button class="btn btn-pink btn-sm font-weight-bold h5 mb-3" href="{{url('account/plans/' . $plan->id . '/pay')}}">Comprar</a>
          @else
          <div class="d-flex justify-content-center mb-3 font-weight-bold">
          <div class="btn-sm font-weight-bold h5 mb-1"></div>
          </div>
          @endif
        </div>

      </div>
    </div>
  