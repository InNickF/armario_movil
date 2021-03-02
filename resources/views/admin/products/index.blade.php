@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1 class="pull-left">Productos</h1>
  {{-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.products.create') !!}">Add New</a>
        </h1> --}}
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
  <div class="d-flex align-items-center mt-4">
    
    <div class="form-group text-primary h6 mr-3">
      {!! Form::label('start_at', 'Desde:') !!}
      <date-selector field-name="start_at" old-value="{{$startFilter}}"></date-selector>
    </div>

    <div class="form-group text-primary h6 mr-3">
      {!! Form::label('end_at', 'Hasta:') !!}
      <date-selector field-name="end_at" old-value="{{$endFilter}}"></date-selector>
    </div>

    <button type="submit" class="btn btn-primary">Filtrar</button>

  </div>
  {!! Form::close() !!}




  <div class="clearfix"></div>
  <div class="card o-hidden border-0 shadow-lg mb-5 mt-2">
    <div class="card-body">
      @include('admin.products.table')
    </div>
  </div>
 
</div>
@endsection
