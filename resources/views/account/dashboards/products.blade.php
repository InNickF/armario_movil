@extends('layouts.account')


@section('title')
    Categorías de productos
@endsection


@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
    <div class="d-flex justify-content-between flex-column flex-xl-row">


      <div class="m-2 my-xl-4 d-flex w-xl-100 justify-content-center">
        <div class="mt-4 m-xl-0 d-inline-flex flex-nowrap bg-light-grey justify-content-center aign-content-center rounded-pill align-self-center">
          <div class="d-inline-block">
            <a href="{{request()->fullUrlWithQuery(array_merge(request()->query(), ['filter'=>'visits']))}}" class="btn btn-sm btn-grey text-primary {{request('filter', 'sales') == 'visits' ? 'active' : ''}}">
              Visitas
            </a>
          </div>
          <div class="d-inline-block">
            <a href="{{request()->fullUrlWithQuery(array_merge(request()->query(), ['filter'=>'sales']))}}" class="btn btn-sm btn-grey text-primary {{request('filter', 'sales') == 'sales' ? 'active' : ''}}">
              Ventas
            </a>
          </div>
        </div>
      </div>
    </div>
    @include('partials.dashboards.top_bar')
  </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card border-0 o-hidden">
        <div class="card-body bg-white">
          @include('account.dashboards.products.products_table')
        </div>
      </div>
    </div>
    <div class="text-sm ml-5"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
    {{-- <div class="col-lg-4">
    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.products.products_sells_by_category')
      </div>
    </div>
  </div> --}}

  </div>
  <div class="row mt-3 ">

    <div class="col-lg-12">
      <div class="card border-0 o-hidden">
        <div class="card-body bg-white">
          @include('account.dashboards.products.products_summary')
        </div>
      </div>
    </div>

  </div>
</div>
@endsection




@section('scripts')
@parent
<script>
  $(document).ready(function() {
    $('#downloadDashboardPdfFakeButton').click(async function(ev) {
      ev.preventDefault();
      var chart = window. {{ $line_chart->id }}

      try {
        uploaded = await uploadGraphAsImage(chart, 'products_{!!$type!!}_dashboard_line_chart_store_{!! auth()->user()->store->id !!}.png')
        $('#downloadDashboardPdfRealButton')[0].click();
      } catch (error) {
        console.error(error);
        alert('Ha ocurrido un error, por favor intenta otra vez o contacta al soporte')
      }

    })
  })
</script>

@stop