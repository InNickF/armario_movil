<!-- Area Chart -->
<div class="col-xl-12">
    <div class="mb-4 card bg-light-grey border-none">
          <!-- Card Header - Dropdown -->
          <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <div class="m-0 h4">Páginas vistas por visita</div>
          </div>
          <div class="mx-4 mb-3 text-sm"><small>Promedio de páginas que se ven en cada visita única a la tienda.</small></div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area h-100">
              <div class="">
                {!! $pages_per_visit_chart->container() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      


@section('scripts')
@parent
{!! $pages_per_visit_chart->script() !!}
@stop
