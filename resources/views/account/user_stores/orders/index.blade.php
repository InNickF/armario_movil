@extends('layouts.account')


@section('title')
Mis ventas
@endsection

@section('content')
<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>

  <div class="mt-2">
    <form action="">

      <div class="container-fluid">

        {{-- Filtros --}}
        <div class="row">
          <div class="col-12">
            <div class="row mb-3 d-flex align-items-center">
              {{-- <div class="col-12 mb-3 d-flex justify-content-between flex-column flex-xl-row"> --}}


              {{-- Buscar --}}
              <div class="col-lg my-2">
                <input type="text" class="form-control form-control-sm text-sm search-icon-filter" name="search"
                  placeholder="Buscar..." value="{{$searchFilter}}">
              </div>


              {{-- Filtros --}}

              <div class="col-lg my-2 text-primary text-lg-right font-weight-bold">
                Filtros:</div>
              <div class="col-6 col-lg my-2 text-primary">
                {!! Form::select('bill_uploaded', $facturasList, $facturasFilter,
                ['placeholder' => 'Selecciona...', 'class' => 'form-control select2 form-control-sm full-rounded w-xl-100'])
                !!}
              </div>

              <div class="col-6 col-lg my-2 text-primary">
                {!! Form::select('status', $statusesList, $statusFilter,
                ['placeholder' => 'Selecciona...', 'class' => 'form-control select2 form-control-sm full-rounded w-xl-100'])
                !!}
              </div>

              <div class="col-6 col-lg my-2 text-primary">
                <date-selector label="Desde:" class="w-100 form-control-sm-container" field-name="start"
                  old-value="{{$startFilter}}"></date-selector>
              </div>

              <div class="col-6 col-lg my-2 text-primary">
                <date-selector label="Hasta:" class="w-100 form-control-sm-container" field-name="end"
                  old-value="{{$endFilter}}"></date-selector>
              </div>

              <div class="col-lg my-2">
                <button class="btn btn-primary btn-sm">Filtrar</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

  <div class="container-fluid mt-2 scroll-tables-div__important">
    <div class="min-width-tables-div__important">
      @include('account.user_stores.orders.table')
    </div>

  </div>
  <div class="text-sm ml-5 mt-3"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información,
      recuerda
      que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small>
  </div>

</div>

@endsection
