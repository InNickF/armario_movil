@extends('layouts.app-front')

@section('content-bottom')
{{-- USER HAS COMPLETE PROFILE {{$user->hasCompleteProfile()}} --}}
<div class="container my-4">
  @include('flash::message')

  <checkout @apply-coupon="applyCoupon" @increase-quantity="increaseProductQuantityInCart"
    @decrease-quantity="decreaseProductQuantityInCart" @remove-product="removeProductFromCart"
    :is-logged-in="{{$isLoggedIn ? 'true' : 'false'}}" continue-to-step="{{$continueToStep}}"
    @calculate-shipping-costs="calculateShippingCosts"
    :has-complete-profile="{{$user && $user->hasCompleteProfile() ? 'true' : 'false'}}"
    >
  </checkout>
</div>

<div class="bg-white p-0">
  {{ Widget::run('testimonials') }}
</div>


@if ($isLoggedIn)
    

<!-- Complete Profile Modal-->
<div class="modal fade" id="completeProfileModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Completa los datos de tu perfil para realizar la compra</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="row">

                <div class="col-12">
                    @include('adminlte-templates::common.errors')
                  {!! Form::model($user, ['route' => ['users.updateProfile'], 'method' => 'post',
                  'files'=>'true', 'id' => 'completeProfileForm']) !!}
                  <div class="row">
                    <input type="hidden" name="redirect" value="checkout">
                    @include('account.users.fields')
                  </div>
                  {!! Form::close() !!}
                  <button class="btn btn-default btn-block" type="button" data-dismiss="modal">Cancelar</button>
                </div>
    
              </div>

          </div>
      </div>
  </div>
</div>
@endif


@endsection
