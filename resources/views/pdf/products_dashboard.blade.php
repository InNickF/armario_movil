@extends('layouts.pdf')

@section('content')
<section class="content-header">
  <h1 class="pull-left text-primary">Productos y categorías</h1>
</section>


<!-- Content Row -->
<div class="row my-3">
  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.products.products_table')
      </div>
    </div>
  </div>

  {{-- <div class="col-lg-4">
    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">
        @include('account.dashboards.products.products_sells_by_category')
      </div>
    </div>
  </div> --}}

</div>
<div class="row mt-3 ">

  <div class="col-12">
    <div class="card border-0 o-hidden">
      <div class="card-body bg-light">        
        <img class="img-fluid" src="{{url('storage/dashboard/products_' . $type . '_dashboard_line_chart_store_' . auth()->user()->store->id). '.png' }}" alt="">
      </div>
    </div>
  </div>

</div>

@endsection
