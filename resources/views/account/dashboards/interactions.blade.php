@extends('layouts.account')



@section('title')
   Interacciones
@endsection



@section('content')
<div class="container-fluid">
@include('partials.dashboards.top_bar')


<!-- Content Row -->
<div class="row">
  <div class="col-lg-12">
    <div class="card border-0 o-hidden">
      <div class="card-body px-0">
        @include('account.dashboards.interactions.interactions_visits_count')
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card border-0 o-hidden">
      <div class="card-body px-0">
        @include('account.dashboards.interactions.interactions_visits_avg_time')
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card border-0 o-hidden">
      <div class="card-body px-0">
        @include('account.dashboards.interactions.interactions_visits_pages_per_visit')
      </div>
    </div>
  </div>
</div>

{{-- <div class="row mt-4">
  <div class="col-lg-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.interactions.interactions_table')
      </div>
    </div>
  </div>
</div> --}}

{{-- <div class="row mt-8">

  <div class="col-lg-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.interactions.interactions_summary')
      </div>
    </div>
  </div>

</div> --}}
</div>
@endsection





@section('scripts')
@parent
<script>

  $(document).ready(function () {
    $('#downloadDashboardPdfFakeButton').click(async function(ev) {
      ev.preventDefault();
      var visits_count_chart = window.{{ $visits_count_chart->id }}
      var visits_avg_time_chart = window.{{ $visits_avg_time_chart->id }}
      var pages_per_visit_chart = window.{{ $pages_per_visit_chart->id }}

      try {
        uploaded = await uploadGraphAsImage(visits_count_chart, 'interactions_dashboard_visits_count_chart_store_{!! auth()->user()->store->id !!}.png')
        uploaded = await uploadGraphAsImage(visits_avg_time_chart, 'interactions_dashboard_visits_avg_time_chart_store_{!! auth()->user()->store->id !!}.png')
        uploaded = await uploadGraphAsImage(pages_per_visit_chart, 'interactions_dashboard_pages_per_visit_chart_store_{!! auth()->user()->store->id !!}.png')
        
        $('#downloadDashboardPdfRealButton')[0].click();
      } catch (error) {
        console.error(error);
        alert('Ha ocurrido un error, por favor intenta otra vez o contacta al soporte')
      }
      
    })
  })
</script>

@stop
