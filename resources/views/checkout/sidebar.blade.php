<div class="mb-5">


  <h5 class="text-primary">Productos:</h5>

  <ul class="list-group">
    @foreach ($order->items as $item)
    <li class="list-group-item text-primary bg-transparent border-primary">{{$item->product_variant->product->name}}</li>
    @endforeach
  </ul>

</div>

<div class="row">
  <div class="col-6">
    <h5>Subtotal:</h5>
  </div>
  <div class="col-6 text-right">
    <h5>@money($order->subtotal + $order->vat_price)</h5>
  </div>
</div>
{{-- <div class="row">
<div class="col-6">
  <h5>IVA:</h5>
</div>
<div class="col-6 text-right">
  <h5>@money($order->vat_price)</h5>
</div>
</div> --}}


<div class="row">
  <div class="col-6">
    <h5>Envío:</h5>
  </div>
  <div class="col-6 text-right">
    <h5>@money($order->total_shipping_price)</h5>
  </div>
</div>



@if ($order->coupon_discount > 0)

<div class="row">
  <div class="col-6">
    <h5>Descuento:</h5>
  </div>
  <div class="col-6 text-right">
    <h5>- @money($order->coupon_discount)</h5>
  </div>
</div>
@endif


<div class="row">
  <div class="col-6">
    <h4 class="font-weight-bold text-primary">Total:</h4>
  </div>
  <div class="col-6 text-right">
    <h4 class="font-weight-bold text-primary">@money($order->total_price)</h4>
  </div>
</div>
