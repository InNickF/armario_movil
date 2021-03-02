@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Editar producto
        </h1>
   </section>
   <div class="content">
        @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="card o-hidden border-0 shadow-lg my-5">
           <div class="card-body">
               {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch']) !!}
                   <div class="row">

                        @include('admin.products.fields')
                        
                    </div>
                   {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection