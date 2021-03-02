@extends('layouts.account')

@section('js-validator')
{{-- JS Validator --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\API\CreateOutfitAPIRequest', '#outfit-wizard-form') !!} --}}
@endsection



@section('title')
    Subir outfit
@endsection

@section('content')
<div class="content">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="card border-none my-2">

    <div class="card-body">
      
      <form id="outfit-wizard-form">

      <outfit-wizard :user="{{json_encode($user)}}"></outfit-wizard>

      </form>

    </div>
  </div>
</div>
@endsection
