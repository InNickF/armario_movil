@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Interacciones</h1>
</section>


<!-- Content Row -->
<div class="row">
  <div class="col-4">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/interactions_dashboard_visits_count_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/interactions_dashboard_visits_avg_time_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/interactions_dashboard_pages_per_visit_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>
</div>

{{-- <div class="row mt-4">
  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.interactions.interactions_table')
      </div>
    </div>
  </div>
</div> --}}

{{-- <div class="row mt-8">

  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.interactions.interactions_summary')
      </div>
    </div>
  </div>

</div> --}}

@endsection
