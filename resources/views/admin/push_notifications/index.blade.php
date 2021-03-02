@extends('layouts.admin')

@section('content')


<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                Notifications
            </h6>
            {{-- <div class="pull-right">
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('notifications.create') !!}">Add
                    New</a>
            </div> --}}
            <div class="element-box bg-light">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary buttons-create btn-lg ml-0" href="{!! url('/admin/push_notifications/create') !!}">
                        <span><i class="fa fa-plus"></i> Crear</span>
                    </a>
                </div>
            </div>
            <div class="element-box mt-2">

                @include('flash::message')

                <div class="table-responsive">

                    @include('admin.push_notifications.table')
                </div>

                <div class="text-center">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection