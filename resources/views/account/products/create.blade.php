@extends('layouts.account')


@section('js-validator')
{{-- JS Validator --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\API\CreateProductAPIRequest', '#product-wizard-form') !!} --}}
@endsection

  @section('title')
    Subir productos
  @endsection

@section('content')
<div class="content">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="mb-5">

    <div class="card-body">
      
      <form id="product-wizard-form">

      <product-wizard :user="{{json_encode($user)}}"></product-wizard>

      </form>

    </div>
  </div>
</div>
@endsection
