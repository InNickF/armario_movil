@extends('layouts.account')

@section('title')
Mis favoritos
@endsection


@section('content')

{!! Form::open(['method' => 'get', 'class' => 'form-inline mb-4']) !!}
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-12">
      <div class="row">

        {{-- Search --}}
        <div class="col-lg d-flex align-items-center">

          <input type="text" name="search" class="form-control form-control-sm search-icon-filter w-xl-100 my-2 my-xl-0"
            placeholder="Buscar" value="{{ $search  ?? '' }}">
        </div>

        <div class="col-lg col-6 d-flex align-items-center">
          <div class="text-primary font-weight-bold text-lg-right mx-2 mb-0 w-100">Filtros:</div>
        </div>

        <div class="col-lg col-6 d-flex justify-content-center align-content-center my-2 my-xl-0">
          {{-- Filter by category --}}
          <select class="align-self-center form-control select2 mr-2 px-5 w-100" name="category">
            <option class="form-control" value="">
              Categoría&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </option>
            @foreach ($categories as $category)
            {{$category->name}}
            <option class="form-control" value="{{ $category->id }}"
              {{ $filtered_category == $category->id ? "selected" : null }}>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-lg col-6 d-flex align-items-center">
          <div class="text-primary font-weight-bold text-lg-right mx-2 w-100">Ordenar por:</div>
        </div>

        <div class="col-lg col-6 d-flex justify-content-center align-content-center my-2 my-xl-0">
          {{-- Order by --}}
          <select class="align-self-center form-control select2 mr-2 w-100" name="order">
            <option class="form-control tex-primary" value="name" {{ $order == "name" ? "selected" : null }}>Ordenar
              Alfabéticamente</option>
            <option class="form-control align-middle text-primary" value="created_at"
              {{ $order == "created_at" ? "selected" : null }}>Ordenar por fecha</option>
          </select>
        </div>

        <div class="col-lg  d-flex align-items-center">
          <button type="submit" class="btn btn-primary btn-sm ml-2 w-xl-100">Filtrar</button>
        </div>
      </div>

    </div>
  </div>
</div>
{!! Form::close() !!}

<div class="container pt-2">
  @include('flash::message')
  <div class="w-100">
    <wishlist :wishlist-prop="{{json_encode($wishlist)}}" @on-add-to-cart="addProductToCart">
      </wishlist>
  </div>
</div>

@endsection
