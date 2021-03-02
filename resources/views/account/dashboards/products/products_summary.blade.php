<!-- Area Chart -->
<div class="col-xl-12">
  <div class="mb-4 card bg-light-grey border-none">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
      @if ($type == 'sales')
      <div>
      <div class="m-0 h4">Resumen gráfico</div>
      <div class="text-sm mt-2"><small>Cantidad de productos vendidos en la tienda por categoría.</small></div>
    </div>
    @else 
    <div>
      <div class="m-0 h4">Resumen gráfico</div>
      <div class="text-sm mt-2"><small>Cantidad de productos vistos en la tienda por categoría.</small></div>
    </div>
    @endif
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area h-100">
        <div class="">
          @if (!empty($line_chart->datasets))
          {!! $line_chart->container() !!}
          @else
          <p>No se han encontrado datos</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
@parent
@if (!empty($line_chart->datasets))
{!! $line_chart->script() !!}
@endif
@stop
