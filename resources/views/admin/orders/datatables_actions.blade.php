{{-- {!! Form::open(['route' => ['admin.orders.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm',
        'onclick' => "return confirm('¿Estás seguro?')"
    ]) !!}
</div>
{!! Form::close() !!} --}}

{{-- 
<div class="mt-3">
  <label class="text-primary h6 font-weight-bold">Activo</label>
  <div class="form-group">
    <label for="">Comentario</label>
    <textarea class="form-control" name="" id="orderComment_{{$model->id}}"
      rows="3">{{$model->admin_comment}}</textarea>
  </div>

  <button id="orderCommentButton_{{$model->id}}"
    class="btn btn-sm btn-block {{$model->is_active ? 'btn-success' : 'btn-danger'}}"
    onclick="storyToggleActive({{$model->id}})">Guardar</button>

</div> --}}
