<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Contenido:') !!}
    <text-editor :old="{{isset($testimonial) ? json_encode($testimonial->body) : 'null'}}"></text-editor>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Usuario:') !!}
    {!! Form::select('user_id', $users->pluck('full_name', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.testimonials.index') !!}" class="btn btn-default">Cancelar</a>
</div>
