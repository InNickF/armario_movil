<!-- Area Chart -->
<div class="col-xl-12">
    <div class="card bg-light-grey border-none">
          <!-- Card Header - Dropdown -->
          <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <div class="m-0 h4">Edad de compradores</div>
          </div>
          <div class="mx-4 text-sm"><small>Rangos de edad de las personas que adquieren los productos de la tienda.</small></div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area h-100">
              <div class="">
                {!! $customers_age_chart->container() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      


@section('scripts')
@parent
{!! $customers_age_chart->script() !!}
@stop
