@extends('layouts.account')



@section('title')
   Producto
  @endsection

@section('content')
@include('flash::message')

<div class="content">

  @include('adminlte-templates::common.errors')
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body">
      {!! Form::model($product, ['route' => ['account.products.update', $product->id], 'method' => 'patch', 'files'=>'true'])
      !!}
      <div class="row">

        @include('account.products.fields')

      </div>
      {!! Form::close() !!}
    </div>
  </div>


  {{-- @include('products.partials.reviews') --}}
</div>
@endsection
