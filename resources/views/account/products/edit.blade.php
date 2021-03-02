@extends('layouts.account')


@section('js-validator')
{{-- JS Validator --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\API\UpdateProductAPIRequest', '#product-wizard-form') !!} --}}
@endsection


  @section('title')
    Editar producto
  @endsection


@section('content')

@include('flash::message')

<div class="container">

  @include('adminlte-templates::common.errors')
  <div class="card o-hidden border-0 my-5">
    <div class="card-body">
    <form id="product-wizard-form">
      <edit-product-form :product-id="{{$product->id}}" :user="{{json_encode(auth()->user())}}"></edit-product-form>
    </form>
    </div>
  </div>


  {{-- @include('products.partials.reviews') --}}
</div>
@endsection
