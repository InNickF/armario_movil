@extends('layouts.account')


@section('title')
    Pagar plan {{$plan->name}}
@endsection


@section('content')
<div class="container my-5">
  @include('flash::message')
  <div class="row">
    <div class="col-12 col-md-7 col-lg-7 order-2 order-md-1">
      <form action="{{ url('/account/subscription/pay') }}" method="POST" id="payOrderForm">
        @csrf
        <plan-checkout></plan-checkout>
        <input type="hidden" name="plan_id" value="{{$plan->id}}">
        
        <input type="hidden" name="coupon_id" value="{{$coupon ? $coupon->id : null}}">
        
        {{-- <div class="col-12">
          <div class="text-center mt-4 mb-5">
            <button id="payOrderButton" type="submit" class="btn btn-primary btn-lg">Pagar</button>
          </div>
        </div> --}}
      </form>
      <div class="text-center">
      <a class="btn btn-default" href="{{url('account/plans/')}}">Cancelar</a>
    </div>
    </div>
    <div class="col-12 col-md-5 col-lg-5 text-center mb-4 text-primary order-1 order-md-2">
     
      <div class="card no-border bg-light">
        <div class="card-body">
          <h3>
            <div class="h3 text-primary mb-3 text-left">Resumen de compra</div>
            <div class="d-flex justify-content-between resumen-total">
            <div class="h3 font-weight-bold"><strong>Total:</div> 
              <div class="h3 font-weight-bold">@money($plan->price)</strong></div>
            </div>
            @if ($coupon)
            <span>(-@money($plan->discount))</span>
            @endif
          </h3>
          @if ($coupon)
          <span>Cupón aplicado: <strong>{{$coupon->name}}</strong> {{$coupon->description}} (-
            {{$coupon->discount}}{{$coupon->type == 'percentage' ? '%' : 'USD'}})</span>
          @endif
          {{-- Coupon field --}}
          <div class="col-12 text-center mt-4">
            <form action="" method="GET" id="planCouponForm">
              @csrf
              <div class="row">
                <div class="col-md-8">
                  <input name="coupon" value="{{$coupon ? $coupon->code : null}}" type="text" class="form-control form-control-transparent text-sm max-height-sm"
                    placeholder="Ingresa tu cupón" />
                </div>
                <div class="col-md-4 mt-2 mt-md-0">
                  <button class="btn btn-strong-pink-2 btn-sm btn-block">Aplicar</button>
                </div>
              </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center align-items-center mt-3">
                <div class="mx-3">
                  <img src="/images/logos/visa-logo.png" alt="..." class="">
                </div>
                <div class="mx-3">
                  <img
                    src="/images/logos/mastercard-logo.png"
                    alt="..."
                    class=""
                  >
                </div>
              </div>
              <p class="text-center mt-3">Tarjetas de crédito, débito y prepago</p>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <input type="hidden" id="userIdField" value="{{auth()->user()->id}}">
  <input type="hidden" id="userEmailField" value="{{auth()->user()->email}}">

</div>
@endsection




@section('scripts')
@parent
<script src="{{ asset('js/paymentez-add-card.js') }}"></script>
@stop
