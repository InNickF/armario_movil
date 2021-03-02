@extends('layouts.account')


@section('title')
   Historial de ventas
@endsection


@section('content')
<div class="container-fluid">
@include('partials.dashboards.top_bar')


<!-- Content Row -->
<div class="container-fluid mt-2 scroll-tables-div__important">
    <div class="min-width-tables-div__important">
    @include('account.dashboards.sell_records.sell_records_table')
  </div>
</div>
<div class="text-sm ml-5 mt-3"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
<div class="container-fluid">
    <!-- Content Column -->
    <div class="col-lg-8 col mx-auto my-4">
    @include('account.dashboards.sell_records.sell_records_totals')
  </div>
</div>
</div>
@endsection




@section('scripts')
@parent
<script>
  $(document).ready(function () {
    $('#downloadDashboardPdfFakeButton').click(function(ev) {
      // No charts, so just pass click event to real btn
      $('#downloadDashboardPdfRealButton')[0].click();
  })
})
</script>
@stop
