@extends('layouts.account')

@section('title')
    Localidades
@endsection


@section('content')
<div class="content mt-4 container-fluid">

  <div class="clearfix"></div>

  @include('flash::message')
  @include('adminlte-templates::common.errors')

  <div class="clearfix"></div>

  <div class="tab-content mb-5" id="updateAddressesApp">

    <div class="tab-pane fade show active" id="addresses-paying" role="tabpanel" aria-labelledby="addresses-paying-tab">
      <update-addresses filter="is_paying" :states="{{json_encode($states)}}"></update-addresses>
    </div>
  </div>

  <div class="text-center">

  </div>
</div>
@endsection
