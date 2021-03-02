<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $notification->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $notification->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $notification->updated_at !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Título:') !!}
    <p>{!! $notification->title !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Contenido:') !!}
    <p>{!! $notification->body !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $notification->user_id !!}</p>
</div>

<!-- Store Id Field -->
<div class="form-group">
    {!! Form::label('store_id', 'Store Id:') !!}
    <p>{!! $notification->store_id !!}</p>
</div>

<!-- Success Field -->
<div class="form-group">
    {!! Form::label('success', 'Success:') !!}
    <p>{!! $notification->success !!}</p>
</div>

<!-- Response Field -->
<div class="form-group">
    {!! Form::label('response', 'Response:') !!}
    <p>{!! $notification->response !!}</p>
</div>

