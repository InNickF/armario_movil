@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Nuevo Slider/Banner
        </h1>
    </section>
    <div class="content">
            @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="card o-hidden border-0 shadow-lg my-5">

            <div class="card-body">
                {!! Form::open(['route' => 'admin.sliders.store']) !!}
                    <div class="row">

                        @include('admin.sliders.fields')

                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
