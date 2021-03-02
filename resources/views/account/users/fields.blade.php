<div class="col-sm-12">
  <div class="d-flex align-items-center">
    <img src="{{asset('/images/profile-icons/profile-persons-icon.png')}}" alt="" class="icon-sm mx-1">
    <div class="h3 text-dark mx-1 mb-0">Datos de usuario
    </div>
  </div>
</div>


      <upload-single-image-button title="Cambiar foto de perfil" class="btn-cambiar-foto mt-4"
        old-image="{{ isset($user) ? json_encode($user->avatar_image) : "" }}" field-name="avatar_image" label="Foto de comprador">
      </upload-single-image-button>

   

<!-- Name Field -->
<div class="form-group my-3 col-sm-6 h6 text-primary mb-4">
  {!! Form::label('first_name', 'Nombre:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('first_name', $user->first_name, ['required', 'placeholder' => 'Nombre', 'class' => 'form-control']) !!}
</div>

<div class="form-group my-3 col-sm-6 h6 text-primary mb-4">
  {!! Form::label('last_name', 'Apellido:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('last_name', $user->last_name, ['required', 'placeholder' => 'Apellido', 'class' => 'form-control']) !!}
</div>


<!-- Email Field -->
<div class="form-group my-3 col-sm-12 h6 text-primary mb-4">
  {!! Form::label('email', 'Dirección de Email:', ['class' => 'font-weight-bold']) !!}
  {!! Form::email('email', $user->email, ['required', 'placeholder' => 'Email', 'class' => 'form-control'])
  !!}
</div>

<!-- Phone Field -->
<div class="form-group my-3 col-sm-12 h6 text-primary mb-4">
  {!! Form::label('phone', 'Teléfono celular:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('phone', $user->phone, ['placeholder' => 'Ingresa número de celular (10 dígitos)', 'class' => 'form-control', 'required', 'pattern' => '\+?[0-9 ]+', 'maxlength' => '10', 'minlength' => 10]) !!}
</div>

<!-- Date Field -->
<div class="form-group my-3 col-sm-12 h6 text-primary mb-4">
  {!! Form::label('dob', 'Fecha de nacimiento:', ['class' => 'font-weight-bold']) !!}
<date-selector field-name="dob" old-value="{{$user->dob}}" required="required"></date-selector>
</div>


<!-- Country Field -->
<div class="form-group my-3 col-sm-12 h6 text-primary mb-4">
    {!! Form::label('country', 'País:', ['class' => 'font-weight-bold']) !!}
    {!! Form::text('country', 'ECUADOR', ['class' => 'form-control bg-transparent', 'required', 'readonly']) !!}
</div>

<div class="form-group my-0 col-sm-12 h6 text-primary">
  <profile-address-fields :user-prop="{{json_encode($user)}}" :ubigeos="{{ json_encode( App\Ubigeo::all()->toArray() ) }}"></profile-address-fields>
</div>


{{-- <div class="form-group my-3 col-sm-12">
    <a href="{{ url('/account/followed_categories') }}" class="btn btn-outline-primary btn-block">Preferencias</a>
  </div> --}}

<!-- gender Field -->
<div class="col-sm-12 my-3">
  <label for="gender" class="h6 text-primary font-weight-bold">Género</label>
  <div class="d-flex flex-wrap justify-content-between">
  
    <div class="form-check mr-1 pl-0">
      <input class="radio-custom" type="radio" name="gender" id="gender1" value="female"  required {{$user->gender == 'female' ? 'checked' : ''}}>
      <label class="radio-custom-label" for="gender1">
        <small>
        Femenino
      </small>
      </label>
    </div>
    <div class="form-check mr-1 pl-0">
      <input class="radio-custom" type="radio" name="gender" id="gender2" value="male" required {{$user->gender == 'male' ? 'checked' : ''}}>
      <label class="radio-custom-label" for="gender2">
        <small>
        Masculino
      </small>
      </label>
    </div>
    <div class="form-check mr-1 pl-0">
      <input class="radio-custom " type="radio" name="gender" id="gender3" value="other" required {{$user->gender == 'other' ? 'checked' : ''}}>
      
      <label class="radio-custom-label" for="gender3">
        <small>
        Prefiero no decirlo
      </small>
      </label>
    </div>
  </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-guardar']) !!}
</div>
