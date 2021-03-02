
<div class="card card-product card-product--no-hover h-100 shadow-sm">


@if ($order_item->product_variant->product)
   <a href="{{$order_item->product_variant->product->url }}">
     <img class="card-img-top img-fluid mx-auto d-block p-0" src="{{ $order_item->product_variant->product->main_image_thumbnail }}">
   </a>
 @endif

 <div class="card-body d-flex px-2">
   <a class="mr-1" href="{{ $order_item->product_variant->product->url ?? '#' }}">
     <span class="text-md title card-title">{{ $order_item->product_variant->product->name ?? 'Producto ya no existe'}}</span>
   </a>
   <div class="price-wrap">
     @if ($order_item->sum_price_final)
     <span class="'price font-weight-bold text-primary h4 color-' + priceColor">@money($order_item->sum_price_final)</span>
     @endif
   </div>
 </div>
 <div class="d-flex justify-content-between align-items-end">
   <div>
     <div class="pl-2 text-sm">Estátus:</div>
     @if ($order_item->status=="Pendiente")
     <div class="ml-2 px-2 text-sm rounded-lg text-white bg-pink justify-content-center">{{$order_item->status}}
     </div>
     @else
     <div class="pl-2 text-sm">{{$order_item->status}}</div>
     @endif
   </div>
   @if ($order_item->product_variant->product)
   <div class="mr-2 mt-1">
     <a href="{{ $order_item->product_variant->product->url ?? '#' }}">
       <div class="btn btn-outline-primary btn-sm font-weight-bold">Detalles</div>
     </a>
   </div>
   @endif
 </div>



 <div class="w-100 px-2 mt-3">
  <edit-review-rating :order-item-id="{{ (int)$order_item->id }}"
    :initial-review="{{ $order_item->review ? json_encode($order_item->review) : 'null' }}"></edit-review-rating>
 </div>

 <div class="card-footer card-footer-account">
  <div class="card-text bottom-wrap">
    @if ($order_item->admin_comment)
        <h5>Observaciones del administrador</h5>
        <p>{{$order_item->admin_comment}}</p>
    @endif


      {{-- <div>Estado: {{$order_item->status}}
    </div> --}}
    {{-- Only show if delivered ? --}}
    {{-- <div class="w-100">
        <edit-review-rating :order-item-id="{{ (int)$order_item->id }}"
    :initial-review="{{ $order_item->review ? json_encode($order_item->review) : 'null' }}"></edit-review-rating>
  </div> --}}

    </div>
  </div>


</div>
