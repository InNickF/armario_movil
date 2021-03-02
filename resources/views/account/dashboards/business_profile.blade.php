@extends('layouts.account')


@section('title')
   Perfil comercial
@endsection


@section('content')

<div class="container-fluid">
@include('partials.dashboards.top_bar')


<!-- Content Row -->
<div class="row">
  <div class="col my-4">
    <div class="card border-0 o-hidden">
      <div class="card-body p-0">
        <div class="col-xl-12">
        @include('account.dashboards.business_profile.business_profile_summary')
        </div>
      </div>
    </div>
  </div>
  <!-- Content Column -->
  <div class="col my-4 col-lg-8">
    <div class="card border-0 o-hidden">
      <div class="card-body p-0">
        @include('account.dashboards.business_profile.business_profile_visits')
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col my-4">
    <div class="card border-0 o-hidden">
      <div class="card-body p-0">
        @include('account.dashboards.business_profile.customers_age')
      </div>
    </div>
  </div>

   <!-- Content Column -->
   <div class="col my-4">
      <div class="card border-0 o-hidden">
        <div class="card-body p-0">
          @include('account.dashboards.business_profile.customers_gender')
        </div>
      </div>
    </div>

</div>

</div>
@endsection






@section('scripts')
@parent
<script>

  $(document).ready(function () {
    $('#downloadDashboardPdfFakeButton').click(async function(ev) {
      ev.preventDefault();
      var customers_age_chart = window.{{ $customers_age_chart->id }}
      var business_profile_visits_chart = window.{{ $business_profile_visits_chart->id }}
      var customers_gender_chart = window.{{ $customers_gender_chart->id }}

      try {
        uploaded = await uploadGraphAsImage(customers_age_chart, 'business_profile_dashboard_customers_age_chart_store_{!! auth()->user()->store->id !!}.png')
        uploaded = await uploadGraphAsImage(business_profile_visits_chart, 'business_profile_dashboard_business_profile_visits_chart_store_{!! auth()->user()->store->id !!}.png')
        uploaded = await uploadGraphAsImage(customers_gender_chart, 'business_profile_dashboard_customers_gender_chart_store_{!! auth()->user()->store->id !!}.png')

        $('#downloadDashboardPdfRealButton')[0].click();
      } catch (error) {
        console.error(error);
        alert('Ha ocurrido un error, por favor intenta otra vez o contacta al soporte')
      }
      
    })
  })
</script>

@stop
