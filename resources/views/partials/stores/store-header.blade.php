<div class="bg-light-grey">
  <div class="container">
    <div class="row mb-4 p-3 ">
      @yield('breadcrumbs')
      <div class="col-sm-12 col-md-6 col-lg-4 text-primary">
        @include('partials.stores.store-profile-sm', ['store' => $store])
      </div>
      <div class="col-sm-12 col-md-6 col-lg-8 d-flex justify-content-center justify-content-md-end flex-wrap text-center align-items-center text-primary">
        {{-- Productos --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-3">
          <div class="big-number font-weight-bold">{{  $store->products->count()}}</div>
          <p>Productos</p>
        </div>
        {{-- Ventas --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-3">
          <div class="big-number font-weight-bold">{{$store->getSoldProductsCount()}}</div>
          <p>Ventas</p>
        </div>
        {{-- Preguntas --}}
        <div class="d-flex flex-wrap flex-column justify-content-center mx-3">
          <div class="big-number font-weight-bold">{{$store->getQuestionsCount()}}</div>
          <p>Preguntas</p>
        </div>

        <div class="d-flex flex-wrap flex-column justify-content-center mx-3">
            <div class="big-number font-weight-bold">{{$store->followers()->count()}}</div>
            <p>Seguidores</p>
          </div>
      </div>
    </div>
  </div>
</div>


