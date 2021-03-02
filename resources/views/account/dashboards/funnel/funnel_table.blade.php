<div class="my-2">
  <div class="pt-3 pb-1 pl-3 mb-0 d-flex flex-row align-items-center justify-content-between bg-light-grey border-radius-15 h4">Embudo de Venta</div>
  <div class="text-sm mt-0 pl-3 bg-light-grey"><small>Proceso que recorre los potenciales clientes de la tienda, desde la primera visita hasta el cierre de la venta.</small></div>
  <div class="table-responsive table-borderless">
    <table class="table" id="funnel-table">
      <thead>
        <tr>
            <th class="text-sm text-primary bg-light-grey pl-3">Categoría</th>
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

        @foreach($data as $eventName => $eventData)

        @php
        $activeColor = $colors[$colorIndex] ?? $colors[0];
        @endphp
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="dot" style="background-color: {{$activeColor}};"></div>
              <div class="text-sm text-primary">{{$eventName}}</div>
            </div>
          </td>
          @foreach ($period as $dt)
          <td class="text-sm text-primary">{{$eventData[$dt->format("M/Y")] ?? '?'}}</td>
          @endforeach
          <td>
            <div class="table-total-bg text-center text-primary text-sm" style="background-color: {{$activeColor}}50;">{{$eventData['total']}}
            </div>
          </td>
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
