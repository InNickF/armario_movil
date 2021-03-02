<!-- Area Chart -->
<div class="col-xl-12">
    <div class="mb-4 card bg-light-grey border-none">
          <!-- Card Header - Dropdown -->
          <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <div class="m-0 h4">Número de visitas únicas</div>
          </div>
          <div class="mx-4 text-sm"><small>Número único de páginas vistas,  hace referencia a la cantidad de sesiones durante las cuales se ha visto la tienda.</small></div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area h-100">
              <div class="">
                {!! $visits_count_chart->container() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      


@section('scripts')
@parent
{!! $visits_count_chart->script() !!}
@stop
