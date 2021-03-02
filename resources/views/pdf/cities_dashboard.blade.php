@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Ciudades</h1>
</section>


<!-- Content Row -->
<div class="row">
  <div class="col-12">

    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.cities.cities_table')
      </div>
    </div>

  </div>


</div>
<div class="row mt-3">

  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/cities_' . $type . '_dashboard_summary_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>

</div>

@endsection

