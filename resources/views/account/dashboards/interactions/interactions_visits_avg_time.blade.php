<!-- Area Chart -->
<div class="col-xl-12">
        <div class="mb-4 card bg-light-grey border-none">
          <!-- Card Header - Dropdown -->
          <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <div class="m-0 h4">Tiempo de visitas promedio</div>
          </div>
          <div class="mx-4 mb-3 text-sm"><small>Tiempo promedio durante el cual los usuarios han visitado la tienda.</small></div>
          <!-- Card Body -->
          
          <p class="text-sm pl-4 mb-1">Promedio:</p>
            <p class="pl-4 mb-1 font-weight-bold text-light-green-2">{{$avg_session_duration}}</p>
          <div class="card-body">
            <div class="chart-area h-100">
              <div class="">
                {!! $visits_avg_time_chart->container() !!}
              </div>
            </div>
          </div>
        </div>  
      </div>
      


@section('scripts')
@parent
{!! $visits_avg_time_chart->script() !!}
@stop
