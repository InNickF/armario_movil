@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left mb-4">Categorías</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.categories.create') !!}">Crear nueva</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                {!! Form::model($categories, ['route' => ['categories.reorder'], 'method' => 'post']) !!}
                    <div id="nestedCategories" class="">
                        <nested-categories :categories="{{ json_encode($categories) }}" :max-depth="3" segment="categories"></nested-categories>
                    </div>
                <button class="btn btn-primary">Guardar cambios</button>
                {!! Form::close() !!}
                {{-- @include('admin.categories.table') --}}
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

