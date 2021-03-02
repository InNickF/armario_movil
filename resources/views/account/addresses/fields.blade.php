<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Main Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('main_street', 'Main Street:') !!}
    {!! Form::text('main_street', null, ['class' => 'form-control']) !!}
</div>

<!-- Secondary Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('secondary_street', 'Secondary Street:') !!}
    {!! Form::text('secondary_street', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
