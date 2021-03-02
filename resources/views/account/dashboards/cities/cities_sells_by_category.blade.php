<!-- Area Chart -->
<div class="col-xl-12">
  <div class="border-0 mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold"> Ventas por categorías</h6>

    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area h-100">
        <div class="d-flex align-items-center h-100 py-4">
          {!! $sells_by_category_chart->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>


@section('scripts')
@parent
{!! $sells_by_category_chart->script() !!}
@stop
