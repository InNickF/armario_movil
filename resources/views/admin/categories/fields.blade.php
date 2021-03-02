<div class="form-group col-sm-12">
  <h4>Ícono SVG</h4>
  <upload-single-image old-image="{{ isset($category) ? json_encode($category->icon_image) : "" }}"
    title="Sube el ícono de esta categoría" field-name="icon_image">
  </upload-single-image>
</div>


<div class="form-group col-sm-12">
  <h4>Ícono JPG</h4>
  <upload-single-image old-image="{{ isset($category) ? json_encode($category->icon_image_jpg) : "" }}"
    title="Sube el ícono de esta categoría" field-name="icon_image_jpg">
  </upload-single-image>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
  {!! Form::label('name', 'Nombre:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Descripción:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('admin.categories.index') !!}" class="btn btn-default">Cancelar</a>
</div>
