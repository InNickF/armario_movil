<div class="form-group col-sm-12">
  <h4>Imagen</h4>
  <upload-single-image old-image="{{ isset($post) ? json_encode($post->main_image) : "" }}"
    title="Sube la imagen de este post" field-name="main_image">
  </upload-single-image>
</div>


<!-- Title Field -->
<div class="form-group col-sm-6">
  {!! Form::label('title', 'Título:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('categories[]', 'Categorías:') !!}
  {!! Form::select('categories[]', array_pluck($categories, 'name', 'id'), null, ['class' => 'form-control select2',
  'multiple' => true]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
  {!! Form::label('description', 'Descripción:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('body', 'Contenido:') !!}
  <text-editor :old="{{isset($post) ? json_encode($post->body) : 'null'}}"></text-editor>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('admin.posts.index') !!}" class="btn btn-default">Cancelar</a>
</div>
