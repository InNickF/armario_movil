@extends('layouts.account')

@section('content')
<div class="container my-5">
  @include('flash::message')
  <div class="row">
    <div class="col-12 text-center mb-4 text-primary">
      <a class="btn btn-default my-2" href="{{url('account/products/')}}">Cancelar</a>
      <h3>
        <strong>TOTAL: @money($transaction->amount)</strong>
      </h3>

    </div>
    <div class="col-12">
      <form action="{{ url('/account/products/bill') }}" method="POST" id="payProductPlanForm">
        @csrf
        <div class="col-lg-12 col-md-12">
          <div class=" text-center">
            <div class="mb-2">
              <h4 class="mb-4">Selecciona datos de facturación</h4>
              <product-plan-select-billing ref="billingSelect"></product-plan-select-billing>

            <input type="hidden" name="product_id" value="{{$product->id}}">
            </div>
          </div>
        </div>
      </form>
    </div>


  </div>

</div>


@endsection
