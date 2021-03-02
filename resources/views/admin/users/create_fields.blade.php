
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>



<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'type' => 'password']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirma contraseña:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'type' => 'password']) !!}
</div>


<!-- Role Field -->
@if (Auth::user()->isA('super-user'))    
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role:') !!}

    {!! Form::select('role_id', array_pluck($roles, 'name', 'id'), isset($user) && count($user->getRoles()) ? $user->getRoles()[0] : null, ['placeholder' => 'Select Role...', 'class' => 'form-control']) !!}

</div>
@endif
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
