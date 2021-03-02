<div class="card border-none my-2">
  <div class="">
    <div class="pt-3 pb-2 pl-3 mb-0 d-flex flex-row align-items-center justify-content-between bg-light-grey border-radius-15 h4">{{$type == 'sales' ? 'Ventas por ciudades' : 'Visitas por ciudades'}}</div>
    <div class="px-3 mt-0 text-sm bg-light-grey"><small>{{$type == 'sales' ? 'Cantidad de productos vendidos en la tienda por ciudad.' : 'Cantidad de productos vistos en la tienda por ciudad.'}}</small></div>
    <div class="table-responsive">
      <table class="table table-first-col-fixed table-borderless" id="sell-records-table">
        <thead class="bg-light-grey border-radius-25">
          <tr>
            <th class="text-sm text-primary bg-light-grey">Ciudad</th>
            @foreach ($period as $dt)
            <th class="text-sm text-primary">{{$dt->format("M/Y")}}</th>
            @endforeach
            <th class="text-sm text-primary font-weight-bold">Total</th>
          </tr>
        </thead>
        <tbody>
          @php
          $colorIndex = 0;
          @endphp
          @foreach($cities as $city_name => $city_data)
  
          @php
          $activeColor = $colors[$colorIndex] ?? $colors[0];
          @endphp
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="dot" style="background-color: {{$activeColor}};"></div>
                <div class="text-sm text-primary">{{$city_name}}</div>
              </div>
            </td>
            @foreach ($period as $dt)
            <td class="text-sm text-primary">{{$city_data[$dt->format("M/Y")] ?? 0}}</td>
            @endforeach
            <td>
              <div class="table-total-bg text-center text-sm text-primary" style="background-color: {{$activeColor}}50;">
                {{$city_data['total']}}</div>
            </td>
          </tr>
          @php
          $colorIndex++;
          @endphp
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- {{ $citys->appends(request()->query())->links() }} --}}
  </div>
</div>
