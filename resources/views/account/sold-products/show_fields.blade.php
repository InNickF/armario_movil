<div class="row">
  <div class="col-12">
      <h2 class="mb-4">Producto: <a href="{{url('/account/products/' . $orderItem->product_variant->product->id . '/edit')}}">{!!
        $orderItem->product_variant->product->name !!}</a></h2>
  </div>
</div>
<div class="row">
  <div class="col-12">
      <h4>Cliente: {{$orderItem->order->user->full_name}}</h4>
  </div>
</div>
<div class="d-flex align-items-center w-100 mb-4 justify-content-between mr-3">
  <!-- Id Field -->
  <div class="d-flex align-items-center">
    <span class="h5 mb-0">
      Número de pedido: {!! $orderItem->order_id !!}
    </span>
    <small class="ml-2">Creado en: {!! $orderItem->created_at !!}</small>
  </div>

  <!-- Status Id Field -->
  <div class="">
    <span>Estado del pedido:</span>
    <div class="badge text-white" style="background-color:{{$orderItem->order->status->color}}">
      {!! $orderItem->order->status->name !!}
    </div>
  </div>
</div>

<br>


<!-- Total Price Field -->
<div class="form-group col-12">
    <p>{!! Form::label('price', 'Cantidad:') !!}
    {!! $orderItem->quantity !!}</p>
    <p>{!! Form::label('price', 'TOTAL:') !!}
    ${!! $orderitem->sum_price_final !!}</p>
</div>


@if ($orderItem->order->coupon)
<!-- Coupon Id Field -->
<div class="form-group col-12">
  {!! Form::label('coupon_id', 'Cupón:') !!}
  <p>{!! $orderItem->coupon->name !!}</p>
</div>
@endif
