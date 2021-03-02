@extends('layouts.admin')



@section('content')


<div class="container">
  <div class="col-12">
    <div class="card mt-5">
      <div class="card-body">
        @include('partials.shipping_orders.table')

      {{-- <a href="{{url('admin/export/pdf/shipping_orders/' . $shipping_order->id)}}"
        class="btn btn-primary">Imprimir</a> --}}
      <a href="{{url('admin/orders')}}" class="btn btn-default">Volver</a>
      </div>
    </div>
  </div>
</div>

@endsection
