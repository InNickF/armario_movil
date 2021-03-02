
{!! Form::open(['route' => 'blog', 'method' => 'get'])!!}

<div class="row">

	<div class="input-group col-12 mx-auto">


		<input name="search" type="text" class="form-control bg-white border-solid small text-sm" placeholder="Buscar en el blog">
		<div class="input-group-append">
			<button class="btn btn-primary font-weight-bold text-sm" type="submit">
				<div class="">Buscar</div>
			</button>
		</div>


	</div>

</div>

{!! Form::close() !!}
