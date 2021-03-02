<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $question->id !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Contenido:') !!}
    <p>{!! $question->body !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $question->user_id !!}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{!! $question->product_id !!}</p>
</div>

<!-- Store Id Field -->
<div class="form-group">
    {!! Form::label('store_id', 'Store Id:') !!}
    <p>{!! $question->store_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $question->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $question->updated_at !!}</p>
</div>

