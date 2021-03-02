@extends('layouts.account')


@section('title')
     Tracking de producto: {{$item->product_variant->product->name}} (Pedido #{{$item->order->id}})
  @endsection


@section('content')


<div class="container px-0">
  <div class="col-12">
    <div class="card mt-5">
      <div class="card-body p-1">
        @if ($item->shipping_order && $item->shipping_order->provider == 'Urbano')

        <div class="embed-responsive embed-responsive-4by3 d-none d-md-block">
          <iframe class="embed-responsive-item" src="https://app.urbano.com.ec/plugin/etracking/etracking/?guia={{$item->shipping_order->tracking_number}}"
            frameborder="0"></iframe>
        </div>

        <div class="embed-responsive embed-responsive-4by9 d-md-none d-block">
          <iframe class="embed-responsive-item" src="https://app.urbano.com.ec/plugin/etracking/etracking/?guia={{$item->shipping_order->tracking_number}}"
            frameborder="0"></iframe>
        </div>

        @endif


        @if ($item->shipping_order && $item->shipping_order->provider == 'Gacela')


        <div class="embed-responsive embed-responsive-4by3 d-none d-md-block">
          <iframe src="https://gacela.co/tracking/{{$item->shipping_order->tracking_number}}" frameborder="0"></iframe>
        </div>

        @endif


        @if ($item->shipping_order && $item->shipping_order->provider == 'Glovo')

       <div class="p-2">
        <h4>Ubicación de tu paquete (Código de tracking: {{ $item->shipping_order->tracking_number }})</h4>
       </div>

        <div class="w-100">
          <glovo-tracking-map :order-item="{{ json_encode($item) }}"></glovo-tracking-map>
        {{-- <img class="img-responsive w-100" src="https://maps.googleapis.com/maps/api/staticmap?center={{$tracking['lat']}},{{$tracking['lon']}}&zoom=15&size=1080x400&maptype=roadmap&markers=icon:https://tinyurl.com/wg2fdgg|{{$tracking['lat']}},{{$tracking['lon']}}&key={{config('googlemaps.key')}}" alt=""> --}}
        </div>

        @endif

        <a href="{{url('account/orders')}}" class="btn btn-outline-primary btn-sm mt-4 m-2">Volver a mis pedidos</a>


      </div>
    </div>
  </div>
</div>



@endsection
