@extends('layouts.account')

@section('title')
Mis productos
@endsection


@section('content')

<div class="content mt-4 container-fluid">
  <div class="row">

    {!! Form::open(['method' => 'get', 'class' => 'col-lg-8 col-12 d-lg-flex align-items-center']) !!}
    <div class="row">
      {{-- Buscar --}}
      <div class="col-lg d-flex align-items-center">
        <form action="" class="w-100">
          <input type="text" class="form-control form-control-sm my-0 search-icon-filter my-3" name="search"
        placeholder="Buscar" value="{{$searchFilter}}">
        </form>
      </div>

      <div class="col-lg col-4 d-flex align-items-center">
        <div class="text-primary mr-3 text-lg-right font-weight-bold w-100">Categorías</div>
      </div>


      <div class="col-lg col-8 d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-center w-100">
          <select class="form-control select2 my-2 w-100" name="category">
            <option class="" value="">Todas</option>
            @foreach ($categories as $category)
            {{$category->name}}
            <option class="" value="{{ $category->id }}" {{ $filtered_category == $category->id ? "selected" : null }}>
              {{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-lg d-flex align-items-center">
        <button type="submit" class="btn btn-sm btn-outline-primary ml-0 ml-xl-2 my-3 my-xl-0 w-100">Filtrar</button>
      </div>
    </div>
    {!! Form::close() !!}

    <div class="col-lg d-flex align-items-center justify-content-end">
      <a class="btn btn-primary font-weight-bold my-2 my-xl-0 btn-sm-block"
        href="{!! route('account.products.create') !!}">Subir producto</a>
    </div>
  </div>
  <div class="">

    @include('flash::message')





    <div class="container">

      <div class="row">

        @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 my-3">
          <div class="card card-account my-3 h-100">
            @include('partials.products.product-card-lg-account')
          </div>
        </div>

        @endforeach
      </div>

    </div>

  </div>

</div>

@endsection
