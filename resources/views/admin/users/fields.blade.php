

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>


<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_name', 'Role:') !!}

    {!! Form::select('role_name', array_pluck($roles, 'name', 'name'), isset($user) && count($user->getRoles()) ? $user->getRoles()[0] : null, ['placeholder' => 'Select Role...', 'class' => 'form-control']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
