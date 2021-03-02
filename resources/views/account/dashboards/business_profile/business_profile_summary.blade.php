
<div style="min-height:497px;" class="card bg-light-grey border-none pt-3 f-flex flex-wrap flex-column justify-content-between">
<div class="text-left h4 mb-3 px-3">Resumen</div>

<div class="text-sm px-3">Número de seguidores:</div>
<div class="h3 text-purple mb-3 px-3">{{$summary['followers_count']}}</div>

<div class="text-sm px-3">Número de ventas:</div>
<div class="h3 text-light-green-2 mb-3 px-3"><strong>{{$summary['sold_products_count']}}</strong></div>

<div class="text-sm px-3">Valor de venta promedio:</div>
<div class="h3 text-light-green-2 mb-3 px-3"><strong>@money($summary['sold_products_average'])</strong></div>

<div class="text-sm px-3">Productos publicados:</div>
<div class="h3 text-purple px-3">{{$summary['published_products_count']}}</div>

<div class="card text-white border-0 mt-4">
  <div class="card bg-light-green card-earning text-white">
    <div class="card-body pt-3">
    <p class="mb-2 h6">Venta global:</p>
    <div class="text-white h1 font-weight-bold">@money($summary['total_sold'])</div>
  </div>
  </div>
</div>
</div>