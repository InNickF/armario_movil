<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Facebook Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook_url', 'Facebook Url:') !!}
    {!! Form::text('facebook_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Twitter Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('twitter_url', 'Twitter Url:') !!}
    {!! Form::text('twitter_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Instagram Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instagram_url', 'Instagram Url:') !!}
    {!! Form::text('instagram_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Youtube Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('youtube_url', 'Youtube Url:') !!}
    {!! Form::text('youtube_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.stores.index') !!}" class="btn btn-default">Cancelar</a>
</div>
