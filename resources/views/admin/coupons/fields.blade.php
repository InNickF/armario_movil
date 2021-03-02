<!-- Name Field -->
<div class="form-group col-sm-6">
  {!! Form::label('name', 'Nombre:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
  {!! Form::label('code', 'Código:') !!}
  {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Descripción:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Field -->
<div class="form-group col-sm-6">
  {!! Form::label('target', 'Objetivo del descuento:') !!}
  {!! Form::select('target', ['products' => 'Productos', 'plans' => 'Planes de suscripción'], null, ['class' => 'form-control']) !!}
</div>

<div class="col-sm-6"></div>


<!-- Plans Field -->
<div class="form-group col-sm-6">
  {!! Form::label('plans[]', 'Planes de suscripción (Opcional, aplica si el objetivo seleccionado es "Planes"):') !!}
  {!! Form::select('plans[]', array_pluck($plans, 'name', 'id'),null, ['class' => 'form-control select2', 'multiple' => true]) !!}
</div>

<!-- Products Field -->
<div class="form-group col-sm-6">
  {!! Form::label('products[]', 'Productos específicos (Opcional, aplica si el objetivo seleccionado es "Productos"):') !!}
  {!! Form::select('products[]', array_pluck($products, 'name', 'id'),null, ['class' => 'form-control select2', 'multiple' => true]) !!}
</div>
<!-- Stores Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stores[]', 'Productos de las siguientes tiendas (Opcional si el objetivo seleccionado es "Productos"):') !!}
    {!! Form::select('stores[]', array_pluck($stores, 'name', 'id'),null, ['class' => 'form-control select2', 'multiple' => true]) !!}
  </div>


<!-- Users Field -->
<div class="form-group col-sm-6">
  {!! Form::label('users[]', 'Usuarios (Opcional si aplica a usuarios específicos):') !!}
  {!! Form::select('users[]', array_pluck($users, 'full_name', 'id'),null, ['class' => 'form-control select2', 'multiple' => true]) !!}
</div>

<!-- categories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories[]', 'Productos de las siguientes categorías (Opcional si el objetivo seleccionado es "Productos"):') !!}
    {!! Form::select('categories[]', $categories->pluck('name_with_parent', 'id'),null, ['class' => 'form-control select2', 'multiple' => true]) !!}
  </div>


<!-- Type Field -->
<div class="form-group col-sm-6">
  {!! Form::label('type', 'Tipo de descuento:') !!}
  {!! Form::select('type', ['percentage' => 'Porcentaje (%)', 'money' => 'Dinero (USD)'], null, ['class' =>
  'form-control']) !!}
</div>

<!-- Discount Field -->
<div class="form-group col-sm-6">
  {!! Form::label('discount', 'Valor de descuento:') !!}
  {!! Form::number('discount', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

<!-- Available Uses Field -->
<div class="form-group col-sm-6">
  {!! Form::label('available_uses', 'Usos disponibles:') !!}
  {!! Form::number('available_uses', null, ['class' => 'form-control']) !!}
</div>

<!-- Uses Count Field -->
<div class="form-group col-sm-6">
  {!! Form::label('uses_count', 'Usos actuales:') !!}
  {!! Form::number('uses_count', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Empieza en:') !!}
   <date-selector field-name="start_at" old-value="{!! isset($coupon) ? $coupon->start_at : null !!}"></date-selector>
  </div>
  <div class="form-group col-sm-6">
    {!! Form::label('end_at', 'Termina en:') !!}
    <date-selector field-name="end_at" old-value="{!! isset($coupon) ? $coupon->end_at : null !!}"></date-selector>
  </div>
  

<!-- Is Active Field -->
<div class="form-group col-sm-6">
  {!! Form::label('is_active', 'Activo:') !!}
  {!! Form::hidden('is_active', false) !!}
  {!! Form::checkbox('is_active',true, null, ['class' => '']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('admin.coupons.index') !!}" class="btn btn-default">Cancelar</a>
</div>