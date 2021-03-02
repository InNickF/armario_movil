<!-- Area Chart -->
<div class="col-xl-12 mt-2 {{!isset($is_export) ? 'scroll-tables-div__important' : ''}}">
  <div class="mb-4 {{!isset($is_export) ? 'min-width-tables-div__important' : ''}} card bg-light-grey border-none">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
      <div class="m-0 h4">Resumen gráfico</div>

    </div>
    <!-- Card Body -->
    <div class="card-body">

      <div class="row">
        <div class="col-3 pl-0 pr-5">
          <div class="text-center text-primary h5 pl-0">
            <p class="mb-2"><img src="{{asset('images/dashboards/dashboard-eye.png')}}" alt=""></p>
            <p>Visitas</p>
          </div>
        </div>

        <div class="col-3 pl-0">
          <div class="text-center text-primary h5">
           <p class="mb-2"><img src="{{asset('images/dashboards/dashboard-question.png')}}" alt=""></p>
            <p>Preguntas / Wishlist</p>
          </div>
        </div>

        <div class="col-3 pl-4">
          <div class="text-center text-primary h5">
              <p class="mb-2"><img src="{{asset('images/dashboards/dashboard-cart.png')}}" alt=""></p>
              <p> Carrito de compras</p>
          </div>
        </div>

        <div class="col-3 pl-3">
          <div class="text-center text-primary h5">
              <p class="mb-2"><img src="{{asset('images/dashboards/dashboard-dollar.png')}}" alt=""></p>
            <p>Ventas</p>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-12 pl-0">
          <img src="{{asset('images/dashboards/sales-funnel.png')}}" class="img-fluid" alt="Responsive image">
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-3 pr-5">
          <div class="text-center text-primary h6">
            {{$data['Visitas']['total'] ?? 0}}
            
              <div class="h3 mt-3 text-red">
               {{$data['Visitas']['percentage'] ?? 0}}% 
                
            
              </div>
          </div>
        </div>

        <div class="col-3 pr-4">
          <div class="text-center text-primary h6">
            {{$data['Preguntas / Wishlist']['total'] ?? 0}}
              <div class="h3 mt-3 text-purple-2">{{$data['Preguntas / Wishlist']['percentage'] ?? 0}}%
              </div>
          </div>
        </div>

        <div class="col-3 pl-5">
          <div class="text-center text-primary h6">
              {{$data['Agregar al carrito']['total'] ?? 0}}
              
                <div class="h3 mt-3 text-light-blue">{{$data['Agregar al carrito']['percentage'] ?? 0}}%
              
              </div>
          </div>
        </div>

        <div class="col-3 pl-3">
          <div class="text-center text-primary h6">
              {{$data['Ventas']['total'] ?? 0}}
              
              <div class="h3 mt-3 text-green-2">  
              {{$data['Ventas']['percentage'] ?? 0}}%
              </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
