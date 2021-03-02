<div class="card-product card-product--no-hover h-100 shadow-none">
  <a href="{{$product->url }}">



    <div class="position-relative">
      <div class="card-img-top img-fluid mx-auto d-block p-0 bg-cover bg-center"
        style="background-image:url('{{ $product->main_image_thumbnail }}'); height:350px"></div>

      @if ($product->has_discount)
      <div class="position-absolute top-0 left-0">
        <div class="bg-pink mx-auto text-white text-center mt-4 en-oferta-pin px-4">OFERTA</div>
      </div>
      @endif
    </div>



    <div class="card-body d-flex px-2 bd-highlight flex-wrap">
      <a class="mr-1 bd-highlight mr-auto col-7 pl-0" href="{{$product->url }}">
        <span class="text-md title card-title">{{ $product->name}}</span>
      </a>
      <div class="price-wrap bd-highlight col-5 pr-0 text-right">
        @if ($product->final_price)
        <span class="'price font-weight-bold text-primary h4 color-' + priceColor">@money($product->final_price)</span>
        @endif
      </div>
    </div>
  </a>




</div>


{!! Form::open(['route' => ['account.products.destroy', $product->id], 'method' => 'delete']) !!}

    <button type="submit" class="btn-delete-product m-2 position-absolute cursor-pointer" onclick="return confirm('¿Estás seguro que deseas borrar permanentemente este producto y todos sus datos asociados (incluyendo registros de ventas, preguntas y respuestas, calificaciones, outfits)?')">
      <i class="fa fa-times"></i>
    </button>

{!! Form::close() !!}



<div class="card-footer card-footer-account px-1 rounded-0 bg-transparent border-0">
  <div class="card-text bottom-wrap">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-2">
      <div class="mb-2">
        <div class="pl-2 text-sm">Estado:</div>
        @if ($product->total_stock && $product->total_stock>0)
        <div class="ml-2 px-2 text-sm rounded-lg text-white bg-pink justify-content-center">En stock</div>

        @else
        <div class="px-2 rounded-lg text-white bg-light-blue text-sm">Fuera de stock</div>

        @endif
      </div>
      <div class=" ml-2 mr-2 mt-1">
        <a href="{{ $product->url }}">
          <div class="btn btn-outline-primary btn-sm font-weight-bold">Detalles</div>
        </a>
      </div>
    </div>
    <div class="mx-2 mt-1 d-flex justify-content-between align-items-end flex-wrap mb-2">
      <div class="mr-2 pt-2">
        <div class="text-sm">Calificación:</div>
        <image-rating src="{{asset('/images/rating/bag-1.png')}}" :rating="{{ (int)$product->getRating() }}"
          :read-only="true" :show-rating="false" class="mx-auto mb-0" :item-size="20"></image-rating>
      </div>
      <a href={{ url("/account/products/".$product->id."/edit/")}}>
        <div class="btn btn-outline-primary btn-sm font-weight-bold mt-2">Editar producto</div>
      </a>
    </div>

    @if(!$product->is_active)
    <p class="text-danger text-sm mb-0 pl-2"><small>Producto inactivo</small></p>
    @if ($product->admin_comment)
    <h5>Observaciones del administrador</h5>
    <p>{{$product->admin_comment}}</p>
    @endif
    @endif
    {{-- <p>Nº de pedido: {{$order_item->order->id}}</p>
    <p>Cantidad: {{$order_item->quantity}}</p> --}}
    {{-- <div class="price-wrap">
          @if ($order_item->sum_price_final)
          <span class="'price text-bold h5 color-' + priceColor">@money($order_item->sum_price_final)</span>
          @endif
        </div> --}}

    {{-- <div>Estado: {{$order_item->status}}
  </div> --}}
  {{-- Only show if delivered ? --}}
  {{-- <div class="w-100">
          <edit-review-rating :order-item-id="{{ (int)$order_item->id }}"
  :initial-review="{{ $order_item->review ? json_encode($order_item->review) : 'null' }}"></edit-review-rating>
</div> --}}

</div>
</div>
