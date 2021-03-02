@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Historial de ventas</h1>
</section>

<!-- Content Row -->
<div class="row my-3">
  <div class="col-12">
    @include('account.dashboards.sell_records.sell_records_table')
  </div>
</div>

<div class="row">
  <!-- Content Column -->
  <div class="col-12 my-4">
      <!-- Color System -->
  <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            Tu ganancia activa
            <div class="text-primary h1">@money($active_earning)</div>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card bg-success text-white shadow">
          <div class="card-body">
            Tu ganancia total
            <div class="text-white h1">@money($total_earning)</div>
          </div>
        </div>
      </div>
  
    </div>
  
  </div>
</div>

@endsection
