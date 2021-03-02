<div class="" id="orders-table">
  <h3 class="h6">Todos los pedidos</h3>

  
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-1 text-primary nombre-rows">Pedido</div>
        <div class="col-3 text-primary nombre-rows">Enviado a nombre de</div>
        <div class="col-2 text-primary nombre-rows">Cantidad de items</div>
        <div class="col-2 text-primary nombre-rows">Fecha</div>
        <div class="col-2 text-primary nombre-rows"><strong>Total</strong></div>
        <div class="col-2"></div>
      </div>
    </div>
  </div>
  <div>
    <div id="accordion">
      @foreach($orders as $key =>$order)
      <div class="card border-0">
        <div class="card-header rounded-0 border-0 {{ $key%2 == 0 ? 'bg-light-grey' : 'bg-white' }}" id="headingOne{{$order->id}}">
          <div class="mb-0">
            <div class="row">
              <div class="col-1 text-primary text-sm">{!! $order->id !!}</div>
              <div class="col-3 text-primary text-sm">{!! $order->shipping_address ? $order->shipping_address->full_name : $order->user->full_name !!}</div>
              <div class="col-2 text-primary text-sm">{!! $order->items->count() !!}</div>
              <div class="col-2 text-primary text-sm">{!! $order->created_at !!}</div>
              <div class="col-2 text-primary text-sm"><strong>@money($order->total_price)</strong></div>
              <div>
                <div class='btn-group'>
                  <button data-toggle="collapse" data-target="#collapseOne{{$order->id}}"
                    class='btn btn-outline-primary btn-sm'><i class=""></i>Mostrar detalles <i class="fa fa-angle-down" aria-hidden="true"></i></button>
                </div>
              </div>

              <div class=" collapse w-100" id="collapseOne{{$order->id}}" aria-labelledby="headingOne{{$order->id}}"
                  data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                    </div>
                    @include('account.orders.show_fields')
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
