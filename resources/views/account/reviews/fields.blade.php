<div class="mb-3">
  <edit-review-rating :rating="{{ (int)$review->rating }}"></edit-review-rating>
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('body', 'Reseña:') !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('account.reviews.index') !!}" class="btn btn-default">Cancelar</a>
</div>
