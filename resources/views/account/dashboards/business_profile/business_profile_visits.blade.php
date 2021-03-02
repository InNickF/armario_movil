<!-- Area Chart -->
<div class="col-xl-12">
  <div class="card bg-light-grey border-none">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
      <h6 class="m-0 h4">Visitas de tu tienda</h6>
    </div>
    <div class="text-sm mx-4"><small>Número total de páginas vistas; las visitas repetidas a una misma página también se contabilizan en la tienda.</small></div>
    <!-- Card Body -->
    <div class="card-body pt-1">
      <div class="chart-area h-100">
        <div class="">
          {!! $business_profile_visits_chart->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
@parent
{!! $business_profile_visits_chart->script() !!}
@stop