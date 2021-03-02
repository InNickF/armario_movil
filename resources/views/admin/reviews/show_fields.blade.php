<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $review->id !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Contenido:') !!}
    <p>{!! $review->body !!}</p>
</div>

<!-- Rating Field -->
<div class="form-group">
    {!! Form::label('rating', 'Rating:') !!}
    <p>{!! $review->rating !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $review->user_id !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $review->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $review->updated_at !!}</p>
</div>

