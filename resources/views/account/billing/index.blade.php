@extends('layouts.account')

@section('title')
    Datos de facturación
@endsection


@section('content')
<div class="content container">

<nav class="btn-sm">
  <div class="nav d-block my-3" id="nav-tab" role="tablist">
    <a class="btn btn-outline-primary btn-sm mr-1 mb-1 active px-5" id="address-paying-tab" data-toggle="tab"
      href="#addresses-paying" role="tab" aria-controls="addresses-paying" aria-selected="true">
      Comprador
    </a> 
    
    <a class="btn btn-sm btn-outline-primary mr-1 mb-1 px-5" id="address-collecting-tab" data-toggle="tab"
      href="#addresses-collecting" role="tab" aria-controls="addresses-collecting" aria-selected="false">
      Tienda
    </a>
  
  </div>
  </nav>
  <div class="clearfix"></div>

  @include('flash::message')
  @include('adminlte-templates::common.errors')

  <div class="clearfix"></div>

  <div class="d-flex align-items-center mb-2">
      <img src="{{url('/images/icons/bill-icon.svg')}}" class="icon-sm mr-2" alt>
      <div class="h4 text-black mb-0 mt-1">Datos de Facturación</div>
    </div>
    {{-- <p class="text-sm text-primary mb-3">Aquí podrás especificar la dirección de tu tienda para emitir facturas fiscales.</p> --}}

  <div class="tab-content mb-5 col-md-8" id="updateAddressesApp">

    <div class="tab-pane fade show active" id="addresses-paying" role="tabpanel" aria-labelledby="addresses-paying-tab">
      <update-billing filter="is_paying" :states="{{json_encode($states)}}"></update-billing>
    </div>

    <div class="tab-pane fade" id="addresses-collecting" role="tabpanel" aria-labelledby="addresses-collecting-tab">
      <update-billing filter="is_collecting" :states="{{json_encode($states)}}"></update-billing>
    </div>
  </div>

  <div class="text-center">

  </div>
</div>
@endsection
