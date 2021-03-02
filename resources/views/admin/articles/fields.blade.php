<div class="form-group col-sm-12">
    <h4>Imagen</h4>
    <upload-single-image old-image="{{ isset($article) ? json_encode($article->main_image) : "" }}"
      title="Sube la imagen de la asesoría" field-name="main_image">
    </upload-single-image>
  </div>
  
  <!-- Title Field -->
<div class="form-group col-sm-6">
  {!! Form::label('title', 'Título:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('categories[]', 'Categorías:') !!}
    {!! Form::select('categories[]', array_pluck($categories, 'name', 'id'), null, ['class' => 'form-control select2', 'multiple'
    => true]) !!}
  </div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
  </div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('body', 'Contenido:') !!}
  <text-editor :old="{{isset($article) ? json_encode($article->body) : 'null'}}"></text-editor>
</div>




<div class="form-group col-sm-6">
    {!! Form::label('plan_id', 'Plan:') !!}
    {!! Form::select('plan_id', array_pluck($plans, 'name', 'id'), null, ['class' => 'form-control select2']) !!}
  </div>
  

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('admin.articles.index') !!}" class="btn btn-default">Cancelar</a>
</div>
