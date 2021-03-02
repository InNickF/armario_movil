@extends('layouts.account')

@section('title')
    Mis outfits
@endsection


@section('content')

<div class="content container-fluid mt-5">
  <div class="row d-flex align-items-end">
  <div class="col-12 text-left ml-4">
    <a class="btn btn-primary font-weight-bold mr-4" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('account.outfits.create') !!}">Subir outfit</a>
  </div>
</div>
  <div class="element-box">

    @include('flash::message')

    {!! Form::open(['method' => 'get', 'class' => 'form-inline mb-4']) !!}

    <div  class="container prod-destacados-account" >
      <div class="card-deck">

        @foreach ($outfits as $outfit)
        <div class="card card-account my-3">
          @include('partials.outfits.outfit-card-lg-account')
         
         </div>
        @endforeach
      </div>
    </div>

    <div class="text-center">

    </div>

  </div>

</div>

@endsection
