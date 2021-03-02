@extends('layouts.admin')

@section('content')

<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Crear Notificación
      </h6>

      <div class="element-box">

        <div class="container">
            @include('flash::message')          @include('adminlte-templates::common.errors')
          <div class="box box-primary">

            <div class="box-body">
              {!! Form::open(['route' => 'admin.push_notifications.store', 'files'=>'true']) !!}
              <div class="row">

                @include('admin.push_notifications.fields')

              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
