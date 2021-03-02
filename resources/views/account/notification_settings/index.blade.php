@extends('layouts.account')


@section('title')
    Notificaciones
@endsection


@section('content')

<div class="container-fluid">

<div class="mt-4">Aquí podrás configurar tus notificaciones y los tipos de notificaciones que quieres recibir para estar
  al
  tanto de todo lo que ocurre en tu Armario.</div>

<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')
  @include('adminlte-templates::common.errors')


  <div class="clearfix"></div>
  <div class="row" id="updateNotificationSettingsApp">
    @foreach ($notificationTypes as $notificationType)

    <div class="col-lg-6 col-12">
      <div class="card o-hidden border-0 shadow-sm my-3">
        <div class="d-flex align-items-center mt-3 px-3">
          <img src="{{ $notificationType->icon }}" class="icon-sm mr-2" alt="">
          <div class="h5 text-primary mb-0 mt-1">{{ $notificationType->name }}</div>
        </div>
        <div class="card-body pt-0">
         <span class="text-sm"><small>{{ $notificationType->description }}</small></span>
          {!! Form::model(auth()->user()->settings, ['route' => ['account.updateNotificationSettings'], 'method' => 'post'])
          !!}
          <div class="">    
            @include('account.notification_settings.notification-setting-card')
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="text-center">

  </div>
</div>
</div>
@endsection
