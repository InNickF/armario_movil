@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Perfil comercial</h1>
</section>


<!-- Content Row -->
<div class="row">
  <div class="col-4">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.business_profile.business_profile_summary')
      </div>
    </div>
  </div>
  <!-- Content Column -->
  <div class="col-8">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/business_profile_dashboard_business_profile_visits_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-8">
    <div class="card border-0 o-hidden">
      <div class="card-body">
          <img class="img-fluid" src="{{url('storage/dashboard/business_profile_dashboard_customers_age_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>

   <!-- Content Column -->
   <div class="col-4">
      <div class="card border-0 o-hidden">
        <div class="card-body">
            <img class="img-fluid" src="{{url('storage/dashboard/business_profile_dashboard_customers_gender_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
        </div>
      </div>
    </div>



</div>

@endsection
