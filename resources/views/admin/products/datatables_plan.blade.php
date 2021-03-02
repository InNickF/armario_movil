
<div class="form-group">
<select class="form-control" name="plan_id" id="planId_{{$product->id}}">
    @foreach ($plans as $plan)
      <option {{$product->plan && ($product->plan->id == $plan->id) ? 'selected' : null}} value="{{$plan->id}}">{{$plan->name}}</option>
    @endforeach
  </select>
</div>

@if ($product->getSubscription())
<p class="mt-2"><small>Vencimiento: {{ $product->getSubscription()->ends_at->format('Y/m/d') }}</small></p>
@endif
<button type="button" class="btn btn-primary btn-sm" onclick="updateProductPlan({{$product->id}})">Guardar cambios</button>
