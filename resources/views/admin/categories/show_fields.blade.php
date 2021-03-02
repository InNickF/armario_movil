<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $category->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Título:') !!}
    <p>{!! $category->title !!}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{!! $category->slug !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{!! $category->description !!}</p>
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', 'Is Active:') !!}
    <p>{!! $category->is_active !!}</p>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{!! $category->parent_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $category->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $category->updated_at !!}</p>
</div>

