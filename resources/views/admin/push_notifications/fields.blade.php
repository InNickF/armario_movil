<!-- Title Field -->

<div class="form-group col-sm-6">
    {!! Form::label('title', 'Título:') !!}
    {!! Form::text('title', isset($notification) ? $notification->title : null, ['placeholder' => 'Ingresa el título', 'class' => 'form-control mb-1', 'required']) !!}
</div>


<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('body', 'Contenido:') !!}
    {!! Form::textarea('body', isset($notification) ? $notification->body : null, ['placeholder' => 'Ingresa el contenido de la notificación', 'class' => 'form-control mb-1', 'required']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.push_notifications.index') !!}" class="btn btn-default">Cancelar</a>
</div>
