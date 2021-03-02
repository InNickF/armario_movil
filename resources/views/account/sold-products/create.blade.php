@extends('layouts.account')



@section('title')
   Producto
  @endsection


@section('content')

    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="card o-hidden border-0 shadow-lg my-5">

            <div class="card-body">
                          
                {!! Form::open(['route' => 'account.products.store']) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        @include('account.products.fields')
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
