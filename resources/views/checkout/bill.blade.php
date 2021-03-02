@extends('layouts.app-front')

@section('content-bottom')
<div class="container my-5" id="wrapper-dashboard">
  @include('flash::message')
  <div class="row">
    <div class="col-12">
      <h1 class="mb-4 text-primary">Datos de facturación</h1>

    </div>
    
    <div class="col-lg-8">
      <div class="row">
        <div class="col-12">

          <form action="{{ url('/bill/' . $order->id) }}" method="POST" id="billAndSend">
            @csrf
            <select-checkout-billing-address></select-checkout-billing-address>
           
          </form>
        </div>
      </div>

    </div>


    <div class="col-lg-4 mb-4">
        <div class="card no-border bg-light">
            <div class="card-body">
        @include('checkout.sidebar')
            </div>
        </div>
  
      </div>

      

  </div>


</div>

@endsection
