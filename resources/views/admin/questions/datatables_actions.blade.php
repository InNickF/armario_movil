{{-- {!! Form::open(['route' => ['admin.questions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('admin.questions.edit', $id) }}" class='btn btn-primary btn-sm'>
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

  <button id="questionIsActiveButton_{{$model->id}}"
    class="btn btn-sm btn-block {{$model->is_active ? 'btn-success' : 'btn-danger'}}"
    onclick="questionToggleActive({{$model->id}})">{{$model->is_active ? 'Activo' : 'Inactivo'}}</button>

</div>
