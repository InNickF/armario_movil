
@if ($store->user && $store->user->id)
    

<div class="form-group">
  <select class="form-control" name="plan_id" id="planId_{{$store->user->id}}">
      @foreach ($plans as $plan)
      <option {{$store->user->plan->id == $plan->id ? 'selected' : null}} value="{{$plan->id}}">{{$plan->name}}</option>
      @endforeach
    </select>
  </div>
  <p class="mt-2"><small>Vencimiento: {{$store->user->getSubscription()->ends_at->format('Y/m/d') ?? 'Ninguna'}}</small></p>

  <button type="button" class="btn btn-primary btn-sm" onclick="updateUserPlan({{$store->user->id}})">Guardar cambios</button>
  @endif