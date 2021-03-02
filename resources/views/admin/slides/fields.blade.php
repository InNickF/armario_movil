<div class="form-group col-sm-12">
  <h4>Imagen</h4>
  <upload-single-image old-image="{{ isset($slide) ? json_encode($slide->image) : "" }}"
    title="Sube la imagen de la diapositiva" field-name="image">
  </upload-single-image>
</div>


<!-- Body Field -->
<div class="form-group col-sm-6 col-lg-6">
  {!! Form::label('body', 'Texto:') !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
  {!! Form::label('url', 'Url:') !!}
  {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Button Text Field -->
<div class="form-group col-sm-6">
  {!! Form::label('button_text', 'Texto en botón:') !!}
  {!! Form::text('button_text', null, ['class' => 'form-control']) !!}
</div>

<!-- Button Theme Field -->
<div class="form-group col-sm-6">
  {!! Form::label('button_theme', 'Estilo botón:') !!}
  {!! Form::select('button_theme', ['light' => 'Claro', 'dark' => 'Oscuro'], null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
  {!! Form::label('order', 'Orden:') !!}
  {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('slider_id', isset($slide) ? $slide->slider_id : request('slider_id', 0) , ['class' => 'form-control']) !!}
<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('admin.sliders.edit', isset($slide) ? $slide->slider->id : request('slider_id', 0)) !!}" class="btn btn-default">Cancelar</a>
</div>
