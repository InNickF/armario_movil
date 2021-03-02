@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Embudo de ventas</h1>
</section>

<!-- Content Row -->
<div class="row">
  <div class="col-12">

    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.funnel.funnel_table')
      </div>
    </div>
  </div>
</div>

<div class="row mt-8">

  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body">
        @include('account.dashboards.funnel.funnel_summary')
      </div>
    </div>
  </div>

</div>

@endsection
