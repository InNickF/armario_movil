@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tiendas</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                    @include('admin.user_stores.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

