{!! Form::open(['route' => ['admin.push_notifications.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    
    <a href="{{ route('admin.push_notifications.edit', $id) }}" class='ml-0 btn btn-primary btn-sm'>
            <i class="fa fa-pencil-alt" aria-hidden="true"></i>

    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'ml-0 btn btn-danger btn-sm',
        'onclick' => "return confirm('¿Estás seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}
