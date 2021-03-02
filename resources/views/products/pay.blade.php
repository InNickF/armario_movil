@extends('layouts.account')

@section('content')

<div class="container my-5">
  @include('flash::message')
  <div class="row">

    <div class="col-12">
      <h1 class="text-primary">Anunciar {{ $product->name }}</h1>
    </div>

    <div class="col-lg-5 col-md-6 col-sm-12 my-5 mx-auto">
      <div class="card no-border bg-light">
        <div class="card-body">


          @include('products.checkout-sidebar')
          <div class="col-12">
            <div class="text-center mt-4 mb-5">
              <button id="js-paymentez-checkout" type="submit" class="btn btn-primary btn-block btn-strong-pink-2 text-lg">Pago corriente</button>
              <p id="response" class="text-danger"></p>
              <a class="btn btn-default btn-lg p-0" href="{{url('account/products/' . $product->id . '/edit')}}">Cancelar</a>
            </div>  
          </div>


          <div class="d-flex flex-wrap justify-content-center align-items-center mt-5">
          
              <img src="{{asset('/images/logos/visa-logo.png')}}" alt="..." class="mx-3">
           
              <img src="{{asset('/images/logos/mastercard-logo.png')}}" alt="..." class="mx-3">
        
          
          </div> 
          <p class="text-center">Tarjetas de crédito, débito y prepago</p>


        </div>
      </div>
    </div>



   

  </div>

  
  {{-- THIS FIELDS ARE NEEDED FOR PAYMENTEZ JS TO WORK --}}
  <input type="hidden" id="userId" value="{{auth()->user()->id}}">
  <input type="hidden" id="userEmail" value="{{auth()->user()->email}}">
  <input type="hidden" id="userPhone" value="{{auth()->user()->phone}}">
  <input type="hidden" id="planDescription" value="{{'Compra de plan de anuncios ' . $plan->name}}">
  <input type="hidden" id="planAmount" value="{{$plan->price}}">
  <input type="hidden" id="planVat" value="{{$plan->price / 1.12}}">
  <input type="hidden" id="orderId" value="product_{{$product->id}}_plan_{{$plan->id}}">
  <input type="hidden" id="planId" value="{{$plan->id}}">
  <input type="hidden" id="productId" value="{{$product->id}}">

</div>

@endsection



@section('scripts')
@parent
<script src="{{ asset('js/paymentez-checkout-product-plans.js') }}"></script>
@stop
