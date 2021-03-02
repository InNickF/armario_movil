<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::select('type', ['slider' => 'Slider (con texto y botones)', 'banner' => 'Banner (solo imagen)'], null, ['class' => 'form-control']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position', 'Posición:') !!}
    {!! Form::select('position', [
        'home_top' => 'Home Slider (superior)',
        'home_banner' => 'Home Banner (abajo del slider)',
        'home_bottom' => 'Slider Home Menú fotográfico (arriba de estadísticas)',
        'category_top' => 'Página de categoría (superior)',
        'category_bottom' => 'Página de categoría (inferior)',
    ], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Categoría (si la posición es página de categoría):') !!}
    {!! Form::select('category_id', $categories->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Selecciona...']) !!}
</div>

{{-- <div class="form-group col-sm-6">
    {!! Form::label('width', 'Ancho en px (opcional):') !!}
    {!! Form::number('width', null, ['class' => 'form-control']) !!}
</div> --}}

{{-- <div class="form-group col-sm-6">
    {!! Form::label('height', 'Alto en px (opcional):') !!}
    {!! Form::number('height', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.sliders.index') !!}" class="btn btn-default">Cancelar</a>
</div>
