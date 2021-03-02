@extends('layouts.account')

@section('title')
    Dispositivos
@endsection


@section('content')

<div class="container-fluid">
@include('partials.dashboards.top_bar')


<!-- Content Row -->
<div class="row">
  <div class="col-lg-8">

    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.devices.devices_table')
      </div>
    </div>

  </div>

  <div class="col-lg-4">

    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.devices.devices_sells_by_category')
      </div>
    </div>
  </div>

</div>
<div class="row mt-8">

  <div class="col-lg-12">
    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.devices.devices_summary')
      </div>
    </div>
  </div>

</div>
</div>
@endsection
