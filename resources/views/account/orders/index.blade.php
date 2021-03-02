@extends('layouts.account')

@section('title')
Mis compras
@endsection


@section('content')

<div class="content container-fluid">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="my-2">
    <form class="" action="">
      <div class="container-fluid">

        {{-- Filtros --}}
        <div class="row mt-4">
          <div class="col-12">
            {{-- Switch --}}
            <div class="row d-flex align-items-center my-4">
              <div class="col-lg my-2">

                <div
                  class="d-inline-flex flex-nowrap bg-light-grey justify-content-center aign-content-center rounded-pill align-self-center">
                  <div class="d-inline-block">

                        @if (request('filter'))
                  <input type="hidden" value="{{request('filter')}}" name="filter">
                  @endif
                  
                    <a href="{{request()->fullUrlWithQuery(array_merge(request()->query(), ['filter'=>'orders']))}}"
                      class="btn btn-sm btn-grey text-primary {{request('filter', 'orders') == 'orders' ? 'active' : ''}}">
                      <small>Pedidos</small>
                    </a>
                  </div>
                  <div class="d-inline-block">
                    <a href="{{request()->fullUrlWithQuery(array_merge(request()->query(), ['filter'=>'order_items']))}}"
                      class="btn btn-sm btn-grey text-primary {{request('filter', 'orders') == 'order_items' ? 'active' : ''}}">
                      <small>Productos</small>
                    </a>
                  </div>
                </div>
              </div>



              {{-- Buscar --}}
              <div class="col-lg my-2 d-flex align-items-center">
                <div class="w-100 mb-0">

                  <input type="text" class="form-control form-control-sm search-icon-filter" name="search"
                    placeholder="Buscar" value="{{$searchFilter ?? null}}">
                </div>
              </div>

              <div class="col-lg my-2 text-primary font-weight-bold text-lg-right">Filtrar por fecha:</div>

              {{-- Filtros Fechas --}}



              <div class="col-6 col-lg my-2 d-flex align-items-center">
                <date-selector label="Desde:" class="w-100 form-control-sm-container" field-name="start"
                  old-value="{{$startFilter ?? null}}"></date-selector>
              </div>

              <div class="col-6 col-lg my-2 d-flex align-items-center">
                <date-selector label="Hasta:" class="w-100 form-control-sm-container" field-name="end"
                  old-value="{{$endFilter ?? null}}"></date-selector>
              </div>


              <div class="col-lg my-2 d-flex align-items-center">
                <button class="btn btn-primary btn-sm ">Filtrar</button>
              </div>
            </div>
          </div>

        </div>

      </div>
    </form>
  </div>

  <div class="container-fluid mt-2 scroll-tables-div__important">
    @if (request()->get('filter') == 'order_items')
    <div>
      @include('account.orders.order-items')
    </div>
    @else
    <div class="min-width-tables-div__important">
      @include('account.orders.table')
    </div>
    @endif
  </div>

  <div class="text-sm ml-5 mt-3"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información,
      recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
</div>
@endsection
