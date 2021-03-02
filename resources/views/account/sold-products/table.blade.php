<table class="table w-100" id="orders-table">
    <thead>
        <tr>
        <th>ID del pedido</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $orderItem)
        <tr>
            <td>{!! $orderItem->order_id !!}</td>
            <td>{!! $orderItem->product_variant->product->name !!}</td>
            <td>{!! $orderItem->quantity !!}</td>
            <td>
                {!! $orderitem->sum_price_final !!}
            </td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('account.sold-products.show', [$orderItem->id]) !!}" class='btn btn-primary btn-sm'><i class="fa fa-eye"></i> Ver detalles</a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>