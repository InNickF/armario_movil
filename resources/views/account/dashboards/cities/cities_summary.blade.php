<!-- Area Chart -->
<div class="col-xl-12">
  <div class="mb-4 card bg-light-grey border-none">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
      <div class="m-0 h4">Resumen gráfico</div>

    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area h-100">
        <div class="">
            @if (!empty($summary_chart->datasets))
            {!! $summary_chart->container() !!}
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
@if (!empty($summary_chart->datasets))
{!! $summary_chart->script() !!}
@endif
@stop
