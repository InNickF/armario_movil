<!-- Area Chart -->
<div class="col-xl-12">
  <div class="mb-4 border-0">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Alcance de tus productos</h6>

    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area h-100">
        <div class="">
          {!! $summary_chart->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>


@section('scripts')
@parent
{!! $summary_chart->script() !!}
@stop
