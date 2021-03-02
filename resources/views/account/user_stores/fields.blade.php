<div class="col-sm-12">
  <div class="d-flex align-items-center">
    <img src="{{asset('/images/profile-icons/profile-store-icon.png')}}" alt="" class="icon-sm mx-1">
    <h4 class="text-dark mx-1 h3 mb-0">Datos de tienda</h4>
  </div>
  <p class="h6 col-sm-12 mt-2"> <small>Si lo deseas, modifica cualquier dato a continuación para que tu cuenta TIENDA DE
      ARMARIO
      esté actualizada.</small> </p>
</div>

<upload-single-image-button title="Cambiar foto de perfil" class="btn-cambiar-foto btn-sm"
  old-image="{{ isset($user) ? json_encode($user->store->logo_image) : "" }}" field-name="logo_image" label="Foto de tienda">
</upload-single-image-button>


<div class="col-sm-12">
  <p class="h6 text-sm"><small>*Sube una imagen cuadrada para que el logo de tu tienda se visualice correctamente</small></p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6 my-3 h6 text-primary">
  {!! Form::label('name', '* Nombre de la tienda:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- document_number Field -->
<div class="form-group col-sm-6 my-3 h6 text-primary">
  {!! Form::label('document_number', '* RUC / Cédula:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('address[document_number]', null, ['placeholder' => 'Ingresa Nº de documento CC ó RUC', 'class' =>
  'form-control', 'minlength' => 10, 'maxlength' => 13, 'required', 'pattern' => '[0-9]+']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6 my-3 h6 text-primary">
  {!! Form::label('address[phone]', '* Teléfono celular:', ['class' => 'font-weight-bold']) !!}
  {!! Form::text('address[phone]', null, ['placeholder' => 'Ingresa número de celular (10 dígitos)', 'class' => 'form-control', 'pattern' => '\+?[0-9 ]+', 'maxlength' => '10', 'minlength' => '10', 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 h6 text-primary my-3">
  {!! Form::label('description', '* Descripción:', ['class' => 'font-weight-bold']) !!}
  {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
</div>

<store-open-hours-form :is-always-open-prop="{{$user->store->is_always_open ? $user->store->is_always_open : "0"}}" class="my-3 col-12">
  <div class="row py-2">
      @include('partials.stores.open_hours_fields')
  </div>
</store-open-hours-form>

<div class="col-12 mt-4">
  <label class="h6 text-primary font-weight-bold">Modo Vacaciones</label>
  <div class="col-md-4 pl-0">
    {!! Form::hidden('is_offline', false) !!}

  {{-- @json($user->store) --}}
    <toggle-button-input value="{{$user->store->is_offline ? 1 : 0}}" field-name="is_offline" />
    </toggle-button-input>
  </div>
  <div class="h6 text-primary font-weight-bold mb-4">
    <small>
      Al activar Modo Vacaciones, tu tienda se ocultará de Armario Móvil
    </small>
  </div>
</div>

<div class="mx-3 my-3">
   <label class="h6 text-primary font-weight-bold">Dirección física para despachos de producto a clientes</label>
  <store-profile-address-fields :old-address="{{ json_encode($user->store->address) }}"
    :states="{{json_encode($states)}}"></store-profile-address-fields>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-primary h5">
  {!! Form::submit('Guardar mi tienda', ['class' => 'btn btn-guardar']) !!}
</div>
