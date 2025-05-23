<modal title="@yield('modal-title')" :show.sync="formModal" effect="fade" width="800">
	<div slot="modal-header" class="modal-header">
		<h4 class="modal-title">
		  <b>@yield('modal-form-title')</b>
		</h4>
	</div>	
	<div slot="modal-body" class="modal-body">
		<div class="content">
			@include('layouts.flash')
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						@yield('modal-form-content')
					</div>
				</div>
			</div>
		</div>
	</div>
	<div slot="modal-footer" class="modal-footer">
		<button type="button" class="btn btn-default" @click='closeModal'>Close</button>
		<button type="button" class="btn btn-success" @click="submit" v-if="$validation.valid">Guardar</button>
	</div>	
</modal>