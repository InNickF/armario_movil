
{!! Form::open(['route' => 'blog', 'method' => 'get'])!!}

<div class="row">

	<div class="input-group col-10 col-md-6 mx-auto">


	<input name="search" type="text" class="form-control bg-white border-solid small" placeholder="Buscar en el blog" value="{{ request('search', null) }}">
		<div class="input-group-append">
			<button class="btn btn-primary font-weight-bold" type="submit">
				<div class="">Buscar</div>
			</button>
		</div>


	</div>

</div>


@if (request('search', null))	
<div class="row">
	<div class="col-12 text-center mt-4">
	<h4 class="text-primary text-bold">Resultados de la búsqueda para: {{request('search')}}</h4>
	</div>
</div>
@endif

{!! Form::close() !!}
