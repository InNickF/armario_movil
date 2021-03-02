@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Slides</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.slides.create') !!}">Crear</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                    @include('admin.slides.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

