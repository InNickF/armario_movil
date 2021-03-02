@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1 class="pull-left">Suscripciones por Email / Contactos</h1>
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')
  {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
  <div class="d-flex align-items-center mt-4">

    <div class="form-group text-primary h6 mr-3">
      {!! Form::label('start_at', 'Desde:') !!}
      <date-selector field-name="start_at" old-value="{{request('start_at')}}"></date-selector>
    </div>

    <div class="form-group text-primary h6 mr-3">
      {!! Form::label('end_at', 'Hasta:') !!}
      <date-selector field-name="end_at" old-value="{{request('end_at')}}"></date-selector>
    </div>

    <button type="submit" class="btn btn-primary">Filtrar</button>

  </div>
  {!! Form::close() !!}


  <div class="clearfix"></div>
  <div class="card o-hidden border-0 shadow-lg mb-5 mt-2">
    <div class="card-body">
      @include('admin.form_requests.table')
    </div>
  </div>
  <div class="text-center">

  </div>
</div>
@endsection
