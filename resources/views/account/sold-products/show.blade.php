@extends('layouts.account')



@section('title')
     Detalles del producto vendido
  @endsection

@section('content')
    <div class="content">
        <div class="card card-primary">
            <div class="card-body">
                <div class="" style="padding-left: 20px">
                    @include('account.sold-products.show_fields')
                    <a href="{!! route('account.sold-products.index') !!}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
