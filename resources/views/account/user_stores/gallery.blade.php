@extends('layouts.account')


@section('title')
    Galería de fotos de mi tienda
@endsection


@section('content')
<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="mt-2">
    <div class="container-fluid">

      {{-- Filtros --}}
      <div class="row">
        <div class="col-12">
          <div class="my-4 store-gallery-preview-grid">

            {!! Form::open(['route' => ['account.store.updateGallery'], 'method' => 'post']) !!}
                    <div class="form-group store-gallery-size__important">
                      <upload-multiple-images
                        :old-images="{{ !empty($store->gallery_images) ? json_encode($store->gallery_images) : "[]" }}"
                        title="Sube las fotos de tu galería" field-name="images" :limit="9">
                      </upload-multiple-images>
                    </div>
                    
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12 d-flex flex-column justify-content-center align-content-center flex-wrap">
                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-4 mx-3 font-weight-bold']) !!}
                      <a href="{!! $store->url .'?about'  !!}" class="btn btn-strong-pink-2 font-weight-bold mt-2 mx-3">Ver en mi tienda</a>
                    </div>
                {!! Form::close() !!}
                

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
