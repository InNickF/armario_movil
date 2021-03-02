<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Contenido:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Rating Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rating', 'Rating:') !!}
    {!! Form::number('rating', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', array_pluck($users, 'name', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::select('product_id', array_pluck($products, 'name', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Store Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('store_id', 'Store Id:') !!}
    {!! Form::select('store_id', array_pluck($stores, 'name', 'id'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.reviews.index') !!}" class="btn btn-default">Cancelar</a>
</div>
