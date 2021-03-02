@extends('layouts.account')



@section('title')
    Mi suscripción
@endsection


@section('content')
<div class="container-fluid">
@include('adminlte-templates::common.errors')
@include('flash::message')
<div class="content mt-3">
  <div class="container">
    <div class="row d-flex justify-content-center pt-0 pt-md-4">
      
     

      @include('account.plans.ropero', ['plan'=>$planRopero])
     
      @include('account.plans.armario', ['plan'=>$planArmario])

      @include('account.plans.closet', ['plan'=>$planCloset])
      

    </div>

  </div>

</div>
</div>
@endsection
