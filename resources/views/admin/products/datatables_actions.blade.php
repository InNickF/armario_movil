{!! Form::open(['route' => ['admin.products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    
    {{-- <a href="{{ $model->url }}" class='btn btn-primary btn-sm' target="_blank">
        <i class="fa fa-eye"></i>
    </a> --}}
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm',
        'onclick' => "return confirm('¿Estás seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}

<div class="mt-3">
<label class="text-primary h6 font-weight-bold">Activo</label>

<button id="productIsActiveButton_{{$model->id}}" class="btn btn-sm btn-block {{$model->is_active ? 'btn-success' : 'btn-danger'}}" onclick="productToggleActive({{$model->id}})">{{$model->is_active ? 'Activo' : 'Inactivo'}}</button>

<div class="form-group">
  <label for="">Comentario</label>
<textarea class="form-control" name="" id="productIsActiveComment_{{$model->id}}" rows="3">{{$model->admin_comment}}</textarea>
</div>

</div>
