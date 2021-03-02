@extends('layouts.account')

@section('content')
<div class="container my-5">
  @include('flash::message')
  <div class="row">
    <div class="col-12 text-center mb-4 text-primary">
      <a class="btn btn-default my-2" href="{{url('account/plans/')}}">Cancelar</a>
      <h3>
        <strong>TOTAL: @money($transaction->amount)</strong>
      </h3>

    </div>
    <div class="col-12">
      <form action="{{ url('/account/subscription/bill') }}" method="POST" id="paySubscriptionForm">
        @csrf
        <div class="col-lg-12 col-md-12">
          <div class>
            <div class="mb-2 text-center">
              <h4 class="mb-4 text-primary">Datos de facturación</h4>
              <product-plan-select-billing ref="billingSelect"></product-plan-select-billing>
            </div>
          </div>
        </div>
      </form>
    </div>


  </div>

  <input type="hidden" id="userIdField" value="{{auth()->user()->id}}">
  <input type="hidden" id="userEmailField" value="{{auth()->user()->email}}">

</div>


@endsection
