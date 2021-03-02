<div class="my-2">
  <!-- Card Header - Dropdown -->
  <div class="py-3 bg-light-grey border-radius-15">
    <div class="m-0 h4 pl-3">
      {{$type == 'sales' ? 'Unidades de productos vendidas por categoría' : 'Visitas a tus productos por categorías'}}</div>
      <div class="mx-3 mt-2 text-sm"><small>{{$type == 'sales' ? 'Cantidad de productos vendidos en la tienda por categoría.' : 'Cantidad de productos vistos en la tienda por categoría.'}}</small></div>
  </div>
  <div class="table-responsive table-borderless">
    <table class="table w-100" id="sell-records-table">
      <thead>
        <tr>
          <th class="text-sm text-primary bg-light-grey">Categoría</th>
          @foreach ($period as $dt)
          <th class="text-sm text-primary bg-light-grey">{{$dt->format("M/Y")}}</th>
          @endforeach
          <th class="text-sm text-primary bg-light-grey font-weight-bold">Total</th>
        </tr>
      </thead>
      <tbody>
        @php
          $colorIndex = 0;
        @endphp
        @foreach($categories as $category_name => $category_data)

        @php
            $activeColor = $colors[$colorIndex] ?? $colors[0];
        @endphp
        <tr>
        <td>
          <div class="d-flex align-items-center">
              <div class="dot" style="background-color: {{$activeColor}};"></div>
          <div class="text-sm text-primary">{{$category_name}}</div>
          </div>
        </td>
          @foreach ($period as $dt)
          <td class="text-sm text-primary">{{$category_data[$dt->format("M/Y")] ?? '?'}}</td>
          @endforeach
          <td><div class="table-total-bg text-center text-sm text-primary" style="background-color: {{$activeColor}}50;">{{$category_data['total']}}</div></td>
        </tr>
        @php
          $colorIndex++;
        @endphp
        @endforeach
      </tbody>
    </table>

    {{-- {{ $products->appends(request()->query())->links() }} --}}
  </div>
</div>
