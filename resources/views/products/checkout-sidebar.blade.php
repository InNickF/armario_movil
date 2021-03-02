<div class="mb-5">

  <h3 class="text-primary">Pagar pedido</h3>

</div>

{{-- <div class="row">
<div class="col-6">
  <h5>IVA:</h5>
</div>
<div class="col-6 text-right">
  <h5>@money($plan->vat_price)</h5>
</div>
</div> --}}


{{-- @if ($coupon)

<div class="row">
  <div class="col-6">
    <h5>DESCUENTO:</h5>
  </div>
  <div class="col-6 text-right">
    <h5>- @money($plan->coupon_discount)</h5>
  </div>
</div>
@endif --}}


<div class="row">
  <div class="col-6">
    <h4 class="text-primary font-weight-bold">Plan {{$plan->name}}:</h4>
  </div>
  <div class="col-6 text-right">
    <h4 class="text-primary font-weight-bold">@money($plan->price)</h4>
  </div>
</div>
