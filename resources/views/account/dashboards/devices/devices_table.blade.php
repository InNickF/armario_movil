<div class="my-2">
  <h3>Visitas por dispositivo</h3>
    <div class="card-body">
            <table class="table w-100" id="sell-records-table">
                    <thead>
                      <tr>
                        <th>Número de pedido</th>
                        <th>Categoría</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha de inicio</th>
                        <th>Ganancia</th>
                        <th colspan="3">Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($devices as $device)
                      <tr>
                        <td>{!! $order_item->order_id !!}</td>
                        <td>{!! $order_item->product_variant->product->category->name !!}</td>
                        <td>{!! $order_item->product_variant->product->name !!}</td>
                        <td>{!! $order_item->quantity !!}</td>
                        <td>{!! $order_item->order->created_at !!}</td>
                        {{-- <td>{!! $order_item->end_date !!}</td> --}}
                        <td>@money($order_item->sum_price_final) </td>
                        <td>
                          <div class="badge text-white" style="background-color: {!! $order_item->order->status->color !!}">
                                {!! $order_item->order->status->name !!}
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
                  {{-- {{ $devices->appends(request()->query())->links() }} --}}
    </div>
</div>