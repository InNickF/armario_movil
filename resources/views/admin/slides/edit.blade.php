@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Editar diapositiva
        </h1>
   </section>
   <div class="content">
        @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="card o-hidden border-0 shadow-lg my-5">
           <div class="card-body">
               {!! Form::model($slide, ['route' => ['admin.slides.update', $slide->id], 'method' => 'patch']) !!}
                   <div class="row">

                        @include('admin.slides.fields')
                        
                    </div>
                   {!! Form::close() !!}

           </div>
       </div>
   </div>
@endsection