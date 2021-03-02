@extends('layouts.account')

@section('js-validator')
{{-- JS Validator --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\API\UpdateOutfitAPIRequest', '#outfit-wizard-form') !!} --}}
@endsection



@section('title')
    Editar outfit
@endsection


@section('content')
<div class="content">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="card border-none my-3">

    <div class="card-body">
      <form id="outfit-wizard-form">

      <edit-outfit :user="{{json_encode($user)}}" :outfit-prop="{{json_encode($outfit)}}"></edit-outfit>

      </form>

    </div>
  </div>
</div>
@endsection
