@extends('layouts.account')

@section('title')
    Plan de producto actualizado
@endsection

@section('content')
<div class="container my-5">
    @include('flash::message')

  <div class="row py-5">
    <div class="col-md-12 text-center">
      <h1 class="text-primary">¡Felicidades!</h1>

      <div class="row">
        <div class="col-md-6 col-sm-10 mx-auto">
          <img class="img-fluid rounded" src="{{$product->main_image}}" alt />
        </div>
      </div>
      <h1 class="text-primary mt-3">{{$product->name}}</h1>
      <div class="text-sm text-primary">
        <small>
          Ha sido actualizado exitosamente al plan de anuncios {{$product->plan->name}}, máximo en dos horas se validará la
          informaciónde tu producto para ser publicada.
        </small>
      </div>
      <p class="text-sm">
        <small>Código de producto: {{ $product->id }}</small>
      </p>

      <div>
        <a href="{{url('account/products')}}" class="btn btn-lg btn-outline-primary mx-3 px-5 pt-2 pb-1">Ir a Mis productos</a>
        <a href="{{url('account/products/create')}}" class="btn btn-lg btn-light-green mx-3 pt-2 pb-1 px-4">Subir
          otro producto</a>
      </div>
    </div>
  </div>
</div>
@endsection
