@extends('layouts.account')


@section('title')
    Mi tienda
  @endsection


@section('content')
<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>


  <div class="clearfix"></div>
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body">
      <div class="row">

        <div class="col-12">
            @include('flash::message')
          @include('adminlte-templates::common.errors')

          <h3 class="element-header">
            Detalles
          </h3>

          {!! Form::model($userStore, ['route' => ['store.update', $userStore->id], 'method' => 'post', 'files'=> true]) !!}

         <div class="row">
                @include('account.user_stores.fields')
         </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection