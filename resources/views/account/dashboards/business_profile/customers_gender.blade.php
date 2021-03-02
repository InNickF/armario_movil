<!-- Area Chart -->
<div class="col-xl-12">
    <div class="mb-4 card bg-light-grey border-none">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
      <div class="m-0 h4">Género de compradores</div>
    </div>
    <div class="mx-4 text-sm"><small>División porcentual de los compradores de la tienda, basado en los géneros femenino y masculino.</small></div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area h-100">
        <div>
          {!! $customers_gender_chart->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>


@section('scripts')
@parent
{!! $customers_gender_chart->script() !!}
@stop
