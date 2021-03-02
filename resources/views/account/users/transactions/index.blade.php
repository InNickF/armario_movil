@extends('layouts.account')


@section('title')
Historial de transacciones
@endsection


@section('content')
<div class="content mt-4 mb-2">
  @include('flash::message')
  @include('adminlte-templates::common.errors')

  <div class="mt-2">
    <form action="">

      <div class="container-fluid">

        {{-- Filtros --}}
        <div class="row">
          <div class="col-12">
            <div class="mb-4">

              {{-- Filtros --}}

              <div class="w-xl-100" action="">
                <div class="d-flex flex-wrap align-items-center">


                  <div class="my-2">
                    <date-selector label="Desde:" class="form-control-sm-container mr-xl-3 mx-0" field-name="start"
                      old-value="{{$startFilter}}"></date-selector>
                  </div>

                  <div class="my-2">
                    <date-selector label="Hasta:" class="form-control-sm-container mr-xl-3 mx-0" field-name="end"
                      old-value="{{$endFilter}}"></date-selector>
                  </div>
                  <div class="form-group my-2">
                    <button class="btn btn-primary btn-sm w-xl-100">Filtrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="tab-content container-fluid mt-2 scroll-tables-div__important" id="updateAddressesApp">


  <div class="min-width-tables-div__important" id="orders-table">
    <h3 class="h6">Todos las transacciones</h3>


    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-2 text-primary nombre-rows">Pedido</div>
          <div class="col-2 text-primary nombre-rows">Fecha</div>
          <div class="col-2 text-primary nombre-rows">Descripción</div>
          <div class="col-2 text-primary nombre-rows">Estado</div>
          <div class="col-2 text-primary nombre-rows">Número de factura</div>
          <div class="col-2 text-primary nombre-rows"><strong>Total</strong></div>
          <div class="col-2"></div>
        </div>
      </div>
    </div>
    <div>
      <div id="accordion">



    @forelse ($transactions as $key => $transaction)
    <div class="card border-0">
      <div class="card-header rounded-0 border-0 {{ $key%2 == 0 ? 'bg-light-grey' : 'bg-white' }}"
        id="headingOne{{$transaction->id}}">
        <div class="mb-0">
          <div class="row">
            <div class="col-2 text-primary text-sm">{{$transaction->transaction_id}}</div>
            <div class="col-2 text-primary text-sm">{{$transaction->created_at->format('Y/m/d')}}</div>
            <div class="col-2 text-primary text-sm">{{$transaction->description}}</div>
            <div class="col-2 text-sm {{$transaction->status == 'success' ? 'text-success' : 'text-danger'}}">
              {{$transaction->status == 'success' ? 'Exitosa' : 'Fallida'}}</div>
            <div class="col-2 text-primary text-sm">{{$transaction->billing_document_id}}</div>
            <div class="col-2 text-primary text-sm">{{ $transaction->is_refund ? '+' : '-' }}
              @money($transaction->amount)</div>
          </div>

        </div>
      </div>
    </div>

    @empty
    <li class="list-group-item"> No se han encontrado resultados</li>

    @endforelse

  </div>
  {{$transactions->links()}}
</div>
</div>



</div>
</div>
<div class="text-sm ml-5 mt-3"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda
    que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
</div>
@endsection
