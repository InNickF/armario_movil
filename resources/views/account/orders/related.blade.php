<div class="w-100">
  <div class="container">

    <div class="tab-pane active show" id="tab_orders">
      <div class="table-responsive">

        <table class="table table-lightborder">
          <thead>
            <tr>
              <th>
                Producto
              </th>
              <th class="text-center">
                Cantidad
              </th>
              <th>
                Precio unidad
              </th>
              <th class="text-right">
                Total
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($order->product_variants as $variant)
            <tr>
              <td>{{$variant->product->name}}</td>
              <div class="cell-image-list">
                @if (!empty($variant->product->main_image))
                <a href="{{$variant->product->url}}">
                  <div class="cell-img" style="background-image: url({{asset('storage/' . $variant->product->main_image) }})"></div>
                </a>
                @endif
              </div>
              <td>
                {{$variant->product->pivot->quantity}}
              </td>

              <td class="nowrap">
                ${{ $variant->product->final_price }}
              </td>
              <td class="nowrap">
                ${{ $variant->product->pivot->sum_price }}
              </td>

            </tr>
            @empty
            <tr>
              <td>
                <p> No results</p>
              </td>
            </tr>
            @endforelse

          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>
