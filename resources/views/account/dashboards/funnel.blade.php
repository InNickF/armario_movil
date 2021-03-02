@extends('layouts.account')

@section('title')
    Embudo de ventas
@endsection

@section('content')

<div class="container-fluid">
@include('partials.dashboards.top_bar')


<!-- Content Row -->
<div class="row">
  <div class="col-lg-12">

    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.funnel.funnel_table')
      </div>
    </div>
  </div>

  <div class="text-sm ml-5"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
</div>

<div class="row mt-8">

  <div class="col-lg-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.funnel.funnel_summary')
      </div>
    </div>
  </div>
  <div class="text-sm ml-5"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
</div>
</div>
@endsection





@section('scripts')
@parent
<script>
  $(document).ready(function () {
    $('#downloadDashboardPdfFakeButton').click(async function (ev) {
      ev.preventDefault();
      // No charts, just pass event to real button
      $('#downloadDashboardPdfRealButton')[0].click();
    })
  })

</script>

@stop
