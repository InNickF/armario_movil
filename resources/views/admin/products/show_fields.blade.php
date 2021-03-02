<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $product->id !!}</p>
</div>

<!-- Store Id Field -->
<div class="form-group">
    {!! Form::label('store_id', 'Store Id:') !!}
    <p>{!! $product->store_id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{!! $product->name !!}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{!! $product->slug !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{!! $product->description !!}</p>
</div>

