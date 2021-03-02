{!! Form::open(['route' => ['categories.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('categories.edit', $id) }}" class='btn btn-primary btn-sm'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm',
        'onclick' => "return confirm('¿Estás seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}
