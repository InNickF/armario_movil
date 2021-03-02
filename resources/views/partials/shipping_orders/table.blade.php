<div class="container">
  <div class="row mt-1">
    <div class="col-6">
      <div class="d-block align-items-center justify-content-center bg-primary rounded py-2">
        <p class="text-white text-center text-sm pt-2">¡Gracias por comprar en www.armariomovil.com!</p>
        <img src="{{setting('logo_image_png', asset('images/icons/logo-armario-movil.png'))}}" class="mx-auto d-block mb-3" alt="" height="40" width="auto">
      </div>
       <div class="mt-3">
          <p>FECHA: {{$shipping_order->created_at->format('Y - m - d')}}</p>
        </div>

    </div>

    <div class="col-6 text-right">
      {{-- BARCODE GENERATION --}}
      <img class="img-fluid" src="{{asset('storage/'.$barcontent)}}" alt="Barcode">

        <div class="mt-2">
          <p>PIEZAS: {{ $shipping_order->order_items->sum('quantity') }}
            <br>
            MONTO ASEGURADO: @money($shipping_order->price)</p>
        </div>

      {{-- <h1>{{$shipping_order->tracking_number}}</h1> --}}
    </div>


   
  </div>


  <div class="row mb-2 mt-1">
      <div class="col-6">
          <ul class="list-group">
              <li class="list-group-item py-1 bg-dark">
                  REMITENTE                
                </li>
              <li class="list-group-item py-1">
               <strong>Tienda:</strong>{{setting('app_name')}} - {{$shipping_order->store->name}}                
              </li>
              <li class="list-group-item py-1">
               <strong>Nombre:</strong> {{$shipping_order->store->user->full_name}}
              </li>
              <li class="list-group-item py-1">
               <strong>Teléfono celular:</strong> {{$shipping_order->store->address->phone}} - {{$shipping_order->store->user->phone}}
              </li>

              <li class="list-group-item py-1">
                 <strong>País, provincia, ciudad:</strong> ECUADOR, {{$shipping_order->store->address->state}}, {{$shipping_order->store->address->city}}
                </li>

                <li class="list-group-item py-1">
                 <strong>Dirección del remitente:</strong>  {{$shipping_order->store->address->street}},  {{$shipping_order->store->address->property_number}}, {{$shipping_order->store->address->secondary_street}}, {{$shipping_order->store->address->reference}}
                </li>
            </ul>
        </div>

      <div class="col-6">
          <ul class="list-group">
              <li class="list-group-item py-1 bg-dark">
                  DESTINATARIO                
                </li>
              <li class="list-group-item py-1">
               <strong>Cliente:</strong> {{$shipping_order->order->user->full_name}}                
              </li>
              <li class="list-group-item py-1">
               <strong>Receptor:</strong> {{$shipping_order->order->user->full_name}}
              </li>
              <li class="list-group-item py-1">
               <strong>Teléfono celular:</strong> {{$shipping_order->order->user->phone}}
              </li>
              <li class="list-group-item py-1">
                <strong>Dirección:</strong> {{$shipping_order->order->shipping_address->street}},  {{$shipping_order->order->shipping_address->property_number}}, {{$shipping_order->order->shipping_address->secondary_street}}
              </li>
              <li class="list-group-item py-1">
                <strong>Referencia:</strong> {{$shipping_order->order->shipping_address->reference}}
              </li>
              <li class="list-group-item py-1">
                <strong>Cantón/Ciudad:</strong> {{$shipping_order->order->shipping_address->district}} - Ubigeo {{$shipping_order->order->shipping_address->ubigeo->ubigeo}}
              </li>
              <li class="list-group-item py-1">
                <strong>Provincia:</strong> {{$shipping_order->order->shipping_address->state}}
              </li>
              <li class="list-group-item py-1">
                  <strong>País:</strong> ECUADOR
                </li>

            </ul>
        </div>
  </div>


</div>