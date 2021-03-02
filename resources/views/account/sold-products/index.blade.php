@extends('layouts.account')

@section('title')
    Mis ventas
@endsection


@section('content')

<div class="content mt-4 container-fluid">

  <div class="container">

    
    <div class="">


      @include('flash::message')

      {!! Form::open(['method' => 'get', 'class' => 'form-inline mb-4']) !!}

      <div class="form-group">
        <label for="category" class="mr-2">Filtrar categoría</label>
        <select class="form-control mr-2" name="category">
          <option class="form-control" value="">Todas</option>
          @foreach ($categories as $category)
          {{$category->name}}
          <option class="form-control" value="{{ $category->id }}"
            {{ $filtered_category == $category->id ? "selected" : null }}>{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
      {!! Form::close() !!}

      <div class="container">
        <div class="row">

          @include('account.sold-products.table')
        </div>
      </div>

      <div class="text-center">
      </div>
    </div>

  </div>

</div>

@endsection
