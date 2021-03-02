<div class="d-flex align-items-center">
  <div class="img-fluid">
    <a href="{{ $store->url }}">
      <img class="avatar-md rounded-circle mx-3 bg-white" src="{{ $store->logo_image }}">
    </a>
  </div>

  <div>
    <a href="{{ $store->url }}">
      <p class="my-2 text-primary">{{ $store->name }}</p>
    </a>
    @include('partials.stores.rating', ['theme' => 'light'])
  

    <div>
     @if (!is_null($store->getOpenHoursRanges()) && !empty($store->getOpenHoursRanges()))
      <p class="text-sm mt-2 text-primary mb-0">Horario de envío:
        <br>
        <i class="fa fa-clock text-primary"></i> {{$store->today_range ? $store->today_range : 'Cerrado'}}
      </p>
      @else
      <p class="text-sm mt-2 text-primary">Horario de envío:
        <br>
        <i class="fa fa-clock text-primary"></i> 24 horas
      </p>
      @endif
    </div>

  </div>
</div>

<div class="container">

  <div class="row">
    <div class="col-12 mt-2">
      @if ($store->is_official)
      <p class="text-left text-pink text-xs ml-1"><i class="fa fa-check"></i> Armario oficial</p>
      @endif
    </div>
  </div>
</div>
