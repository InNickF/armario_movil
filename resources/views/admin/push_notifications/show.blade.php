@extends('layouts.app')

@section('content')

<div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Notification
                </h6>
            
                <div class="element-box">
                        <div class="container">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <div class="row" style="padding-left: 20px">
                                            @include('notifications.show_fields')
                                            <a href="{!! route('notifications.index') !!}" class="btn btn-default">Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>


    
@endsection
