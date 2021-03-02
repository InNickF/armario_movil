{!! Form::open(['route' => ['admin.stores.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
  <a href="{{ $model->url }}" class='btn btn-primary btn-sm'>
    <i class="fa fa-eye"></i>
  </a>
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-danger btn-sm',
  'onclick' => "return confirm('¿Estás seguro?')"
  ]) !!}
</div>
{!! Form::close() !!}


{{-- Toggle Armario Oficial --}}
<div class="mt-3">

  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input" name="" id="storeIsOfficialInput_{{$model->id}}"
        {{$model->is_official ? 'checked' : ''}}>
      Armario oficial
    </label>
  </div>
  <button id="storeIsOfficialButton_{{$model->id}}"
    class="btn btn-sm btn-block btn-primary"
    onclick="storeToggleIsOfficial({{$model->id}})">
    Guardar
  </button>
</div>
