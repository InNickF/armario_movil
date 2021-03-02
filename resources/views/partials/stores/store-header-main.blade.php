<div class="bg-transparent">
  <div class="container px-0 px-md-2 pt-3">
    <div class="row">
      {{-- <div class="col-12">
        {{ Breadcrumbs::render('product', $product) }}
    </div> --}}
    <div class="col-md-5 col-lg-3 col-12 d-flex justify-content-center justify-content-md-end">
      <div class="mb-avatar-store z-999 d-inline-block {{ $store->latest_story ? 'offer-24-avatar-store' : '' }}">
        <store-logo :store="{{json_encode($store)}}"></store-logo>

        {{-- <a href="{{ $store->url }}">
        <img class="img-fluid avatar-lg rounded-circle mx-3 mt-3" src="{{ $store->logo_image }}">
        </a> --}}
        @if ($store->is_official)
        <div class="text-center check-text--color__responsive text-pink text-small"><i
            class="mr-1 far fa-check-circle"></i><small><strong>Armario oficial</strong></small></div>
        @else
        <div class="mt-4"></div>
        @endif
      </div>
    </div>
    <div class="col-lg-4 col-md-7 col-12">
      <div class="pb-1">
        <p class="my-2 text-white h2 font-wheight-bold text-md-left text-center">
          {{ $store->name }}
        </p>

        <div
          class="d-flex flex-wrap flex-md-nowrap star-rating-sm justify-content-md-start justify-content-center align-items-center">
          @include('partials.stores.rating', ['theme' => 'dark'])


          @if (!is_null($store->getOpenHoursRanges()) && !empty($store->getOpenHoursRanges()))

          <div id="hoursPopover"
            class="w-sm-100 d-flex justify-content-center justify-content-md-start align-items-center mt-3 mt-md-0">
            <div class="fa fa-clock text-white ml-3 mr-2"></div>
            <div class="text-white">
              {{$store->today_range ? $store->today_range : 'Cerrado'}}
            </div>
          </div>

          @php
          $days = $store->getOpenHoursRanges();
          @endphp

          @include('partials.stores.open_hours_popover')

          @else
          <div id="hoursPopover"
            class="w-sm-100 d-flex justify-content-center justify-content-md-start align-items-center mt-3 mt-md-0">
            <div class="fa fa-clock text-white ml-3 mr-2"></div>
            <div class="text-white">
              Abierto 24 horas
            </div>
          </div>
          @endif
        </div>

      </div>

      @if (auth()->check())
      <div class="d-flex mt-2 d-flex flex-wrap justify-content-md-start justify-content-center align-items-center">
        @if (auth()->check() && $store->user->id == auth()->user()->id)
        <div class="mt-2 mr-2">
          <a href="{{url('/account/profile')}}" class="btn btn-sm btn-light">Editar perfil</a>
        </div>
        @endif

        <div class="mt-2 mr-2 d-flex flex-wrap justify-content-md-start justify-content-center align-items-center">
          @if ($store->isFollowedBy(auth()->user()))
          <a href="{{url('/stores/'.$store->id.'/follow')}}" class="btn btn-white btn-sm
                ">Dejar de
            seguir</a>
          @else
          <a href="{{url('/stores/'.$store->id.'/follow')}}" class="btn btn-white btn-sm text-sm">Seguir</a>
          @endif
        </div>
      </div>
      @endif

    </div>


    <div class="mx-auto">
      <div
        class="d-flex flex-wrap text-center justify-content-sm-around justify-content-around justify-content-md-center align-items-center w-100 mt-3 mt-md-0">
        {{-- Productos --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-2">
          <div class="big-number text-white font-weight-bold">{{$store->products->count()}}</div>
          <p class="text-white">Productos</p>
        </div>
        {{-- Ventas --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-2">
          <div class="big-number text-white font-weight-bold">{{$store->getSoldProductsCount()}}</div>
          <p class="text-white">Ventas</p>
        </div>
        {{-- Preguntas --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-2">
          <div class="big-number text-white font-weight-bold">{{$store->getQuestionsCount()}}</div>
          <p class="text-white">Preguntas</p>
        </div>

        <div class="d-flex flex-wrap flex-column justify-content-center mx-2">
          <div class="big-number text-white font-weight-bold">{{$store->getFollowersFormatted()}}</div>
          <p class="text-white">Seguidores</p>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-0 m-0 p-0">
    </div>
    <div class="col-lg-9 col-12 d-flex d-lg-block justify-content-center p-0">
      <ul class="nav nav-tabs nav-tabs-transparent mt-2 border-bottom-0" id="myTab" role="tablist">
        <li class="nav-item border-0 bg-transparent">
          <a class="nav-link {{!request()->has('about') ? 'active' : ''}} text-white border-left-0 border-right-0 border-top-0 store-text-tap__responsive rounded-border"
            id="products-tab" data-toggle="tab" href="#store-products" role="tab">Productos</a>

        </li>
        <li class="nav-item border-0 bg-transparent">
          <a class="nav-link text-white border-left-0 border-right-0 border-top-0 store-text-tap__responsive rounded-border"
            id="reviews-tab" data-toggle="tab" href="#reviews" role="tab">Calificaciones</a>
        </li>
        <li class="nav-item border-0 bg-transparent">
          <a class="nav-link {{request()->has('about') ? 'active' : ''}} text-white border-left-0 border-right-0 border-top-0 store-text-tap__responsive rounded-border"
            id="about-tab" data-toggle="tab" href="#about" role="tab">Sobre nosotros</a>
        </li>
      </ul>
    </div>
  </div>


</div>



</div>






<!-- CREATE STORY MODAL -->
<stories-modal ref="StoriesModal" :stores="{{  json_encode([$store]) }}"></stories-modal>
