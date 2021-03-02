@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Crear Categoría
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card o-hidden border-0 shadow-lg my-5">

            <div class="card-body">
                {!! Form::open(['route' => 'admin.categories.store']) !!}
                    <div class="row">

                        @include('admin.categories.fields')

                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
