@extends('layouts.admin')

@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                Administrar notificación
            </h6>
        
            <div class="element-box">
                    @include('flash::message') 
                <div class="container">
                    @include('adminlte-templates::common.errors')
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::model($notification, ['route' => ['admin.push_notifications.update', $notification->id], 'method' => 'patch', 'files'=>'true']) !!}
                                <div class="row">

                                        @include('admin.push_notifications.fields')

                                    </div>
                            {!! Form::close() !!}
                            
                            <a class="btn btn-secondary" href="{{ url('/admin/push_notifications/send/' . $notification->id) }}">Enviar push notification</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection