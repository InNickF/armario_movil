
{!! Form::open(['route' => 'faqs', 'method' => 'get'])!!}

<div class="row">

	<div class="input-group col-10 col-md-6 mt-2 mx-auto mb-4">


		<input name="search" type="text" class="form-control bg-light border-0 small box-shadow" placeholder="Buscar...">
		<div class="input-group-append">
			<button class="btn btn-primary" type="submit">
				<div class="">Buscar</div>
			</button>
		</div>


	</div>

</div>

{!! Form::close() !!}
