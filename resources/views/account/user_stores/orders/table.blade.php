<div class="" id="orders-table">
  <h3 class="h6">Todos los pedidos</h3>

  <div class="card">
    <div class="card-header bg-light-2">
      <div class="row">
        <div class="col-2 text-primary"><small>Pedido</small></div>
        <div class="col-2 text-primary"><small>Enviado a nombre de</small></div>
        <div class="col-2 text-primary"><small>Cantidad de items</small></div>
        <div class="col-2 text-primary"><small>Fecha del pedido</small></div>
        <div class="col-2 text-primary font-weight-bold"><small>Total</small></div>
        <div class="col-2"></div>
      </div>
    </div>
  </div>
  <div>
    <div id="accordion">
      @foreach($orders as $key =>$order)
      <div class="card border-0">
        <div class="card-header rounded-0 border-0 {{ $key%2 == 0 ? 'bg-light-grey' : 'bg-white' }}"
          id="headingOne{{$order->id}}">
          <div class="mb-0">
            <div class="row">
              <div class="col-2 text-primary"><small>{!! $order->id !!}</small></div>
              <div class="col-2 text-primary"><small>{!! $order->user->full_name !!}</small></div>
              <div class="col-2 text-primary"><small>{!! $order->product_variants->count() !!}</small></div>
              <div class="col-2 text-primary"><small>{!! $order->created_at !!}</small></div>
              <div class="col-2 text-primary"><strong>@money($order->getItemsByStore(auth()->user()->store->id)->sum('sum_price_final') ?? '?')</strong></div>
              <div>
                <div class='btn-group'>
                  <button data-toggle="collapse" data-target="#collapseOne{{$order->id}}"
                    class='btn btn-outline-primary btn-sm'><i class=""></i><small>Mostrar detalles</small></button>
                </div>
              </div>

              <div class="collapse w-100" id="collapseOne{{$order->id}}" aria-labelledby="headingOne{{$order->id}}"
                data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                  </div>
                  @include('account.user_stores.orders.show_fields')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    {{$orders->links()}}
  </div>
</div>
