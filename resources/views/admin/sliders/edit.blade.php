@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Editar Slider/Banner
        </h1>
   </section>
   <div class="content">
        @include('flash::message')
       @include('adminlte-templates::common.errors')
       <div class="card o-hidden border-0 shadow-lg my-5">
           <div class="card-body">
               {!! Form::model($slider, ['route' => ['admin.sliders.update', $slider->id], 'method' => 'patch']) !!}
                   <div class="row">

                        @include('admin.sliders.fields')
                        
                    </div>
                   {!! Form::close() !!}

                   {{-- Related Slides --}}
                    @if (isset($slider))
                        
                    <div class="form-group col-12 mt-5">
                        {!! Form::label('slides', 'Diapositivas:') !!}
                        <div class="">
                            <a href="{{url('admin/slides/create?slider_id=' . $slider->id)}}" class="btn btn-primary mb-2">Crear diapositiva</a>
                            @include('admin.slides.table', ['slides' => $slider->slides])
                        </div>
                        
                    </div>
                    @endif
           </div>
       </div>
   </div>
@endsection