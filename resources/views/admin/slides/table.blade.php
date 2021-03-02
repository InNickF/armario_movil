<table class="table table-responsive" id="slides-table">
    <thead>
        <tr>
            <th>Orden</th>
            <th>Imagen</th>
            <th>Texto</th>
        <th>Url</th>
        <th>Texto en botón</th>
        <th>Estilo botón</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($slides as $slide)
        <tr>
            <td>{!! $slide->order !!}</td>
            <td>
                <img src="{!! $slide->image !!}" class="img-fluid">
            </td>
            <td>{!! $slide->body !!}</td>
            <td>{!! $slide->url !!}</td>
            <td>{!! $slide->button_text !!}</td>
            <td>{!! $slide->button_theme !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.slides.destroy', $slide->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.slides.edit', [$slide->id]) !!}" class='btn btn-primary btn-sm'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>