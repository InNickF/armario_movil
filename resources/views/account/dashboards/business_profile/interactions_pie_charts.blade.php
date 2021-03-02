<!-- Area Chart -->
<div class="col-xl-12">
  <div class="border-0 mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Interacciones</h6>

    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="row">

        <div class="col-4 text-center">
          <div class="chart-area">
            <div class="d-flex align-items-center h-100 py-4">
              {!! $interactions_chart1->container() !!}
            </div>
          </div>
          <div>
            <h5>Compartidos</h5>
          </div>
        </div>

        <div class="col-4 text-center">
          <div class="chart-area">
            <div class="d-flex align-items-center h-100 py-4">
              {!! $interactions_chart2->container() !!}
            </div>
          </div>
          <div>
            <h5>Comentarios</h5>
          </div>
        </div>

        <div class="col-4 text-center">
          <div class="chart-area">
            <div class="d-flex align-items-center h-100 py-4">
              {!! $interactions_chart3->container() !!}
            </div>
          </div>
          <div>
            <h5>Wishlist</h5>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


@section('scripts')
@parent
{!! $interactions_chart1->script() !!}
{!! $interactions_chart2->script() !!}
{!! $interactions_chart3->script() !!}
@stop
