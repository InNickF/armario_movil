{{-- {!! Form::open(['route' => ['admin.stories.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
  <a href="{{ route('admin.stories.edit', $id) }}" class='btn btn-primary btn-sm'>
    <i class="fa fa-edit"></i>
  </a>
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-danger btn-sm',
  'onclick' => "return confirm('¿Estás seguro?')"
  ]) !!}
</div>
{!! Form::close() !!} --}}



<div class="mt-3">
  <label class="text-primary h6 font-weight-bold">Activo</label>

  <button id="storyIsActiveButton_{{$model->id}}"
    class="btn btn-sm btn-block {{$model->is_active ? 'btn-success' : 'btn-danger'}}"
    onclick="storyToggleActive({{$model->id}})">{{$model->is_active ? 'Activo' : 'Inactivo'}}</button>

  <div class="form-group">
    <label for="">Comentario</label>
    <textarea class="form-control" name="" id="storyIsActiveComment_{{$model->id}}"
      rows="3">{{$model->admin_comment}}</textarea>
  </div>

</div>
