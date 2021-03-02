@extends('layouts.app-front')

@section('content-bottom')
<div class="container my-5">
  @include('flash::message')
  <div class="row">
    <div class="col-12">
      <h1 class="mb-4 text-primary">Resumen de compra</h1>  
    </div>

    <div class="col-lg-5 col-md-6 col-sm-12 mb-4 mx-auto">
      <div class="card no-border bg-light">
        <div class="card-body">

          @include('checkout.sidebar')
          <div class="col-12">
            <div class="text-center my-2">
              <button id="js-paymentez-checkout" type="submit" class="btn btn-primary btn-block btn-strong-pink-2 mb-2 text-lg">Pagar corriente</button>
              <button id="js-paymentez-checkout-deferred" type="submit" class="btn btn-outline-primary bg-transparent text-lg btn-block">Pagar diferido</button>
              <p id="response" class="text-danger"></p>
            </div>
          </div>
          <div class="text-primary text-sm text-center">*Pagos diferidos solo con Pacificard</div>
          <div class="d-flex flex-wrap justify-content-center align-items-center mt-2">
              <img src="{{asset('/images/logos/visa-logo.png')}}" alt="..." class="mr-4">
              <img src="{{asset('/images/logos/mastercard-logo.png')}}" alt="..." class="ml-4">
          </div>
          <p class="text-center text-sm mt-2 mb-0">Tarjetas de crédito, débito y prepago</p>

        </div>
      </div>
    </div>
  </div>

  {{-- THIS FIELDS ARE NEEDED FOR PAYMENTEZ JS TO WORK --}}
  <input type="hidden" id="userId" value="{{auth()->user()->id}}">
  <input type="hidden" id="userEmail" value="{{auth()->user()->email}}">
  <input type="hidden" id="userPhone" value="{{auth()->user()->phone}}">
  <input type="hidden" id="orderDescription" value="{{'Compra de productos en ' . setting('app_name')}}">
  <input type="hidden" id="orderAmount" value="{{$order->total_price}}">
  <input type="hidden" id="orderVat" value="{{$order->vat_price}}">
  <input type="hidden" id="orderId" value="{{$order->id}}">
  <input type="hidden" id="orderUuid" value="{{$order->uuid}}">


</div>

@endsection



@section('scripts')
@parent
<script src="{{ asset('js/paymentez-checkout.js') }}"></script>
@stop
