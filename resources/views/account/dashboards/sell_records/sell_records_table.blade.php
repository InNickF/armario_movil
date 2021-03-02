<div class="card border-none my-2">
  <div class="orders-table table-responsive border-radius-15">
    <table class="table table-borderless w-100" id="sell-records-table">
      <thead class="bg-light-grey">
        <tr>
          <th class="text-sm text-primary">No. pedido</th>
          <th class="text-sm text-primary">Categoría</th>
          <th class="text-sm text-primary">Producto</th>
          <th class="text-sm text-primary">Cantidad</th>
          <th class="text-sm text-primary">Fecha</th>
          <th class="text-sm text-primary">Ganancia</th>
          <th colspan="3" class="text-sm text-primary">Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order_items as $order_item)
        <tr>
          <td class="text-sm text-primary">{!! $order_item->order_id !!}</td>
          <td class="text-sm text-primary">{!! $order_item->product_variant->product->category->name !!}</td>
          <td class="text-sm text-primary">{!! $order_item->product_variant->product->name !!}</td>
          <td class="text-sm text-primary">{!! $order_item->quantity !!}</td>
          <td class="text-sm text-primary">{!! $order_item->created_at !!}</td>
          {{-- <td>{!! $order_item->end_date !!}</td> --}}
          <td class="text-sm text-primary">@money($order_item->earning)</td>
          <td>
            <div class="badge text-primary" style="background-color: {!! $order_item->color !!}">
              {!! $order_item->status !!}
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      {{ $order_items->appends(request()->query())->links() }}
    </div>
  </div>
</div>
