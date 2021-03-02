@extends('layouts.pdf')



@section('content')


<div class="container">
  <div class="col-12">
          {{-- Print twice --}}
          <div>
            @include('partials.shipping_orders.table')
          </div>
          <div class="mt-3">
            @include('partials.shipping_orders.table') 
          </div>
  </div>
</div>

@endsection
