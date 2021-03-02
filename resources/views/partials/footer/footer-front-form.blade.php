<p class="mx-auto mt-5"><strong>SUSCRÍBETE PARA RECIBIR OFERTAS</strong></p>

<form action="{{url('form_requests_email')}}" class="suscribete-home px-5 mx-auto my-3" method="POST">
  @csrf
    <div class="input-group">
      <input name="origin" type="hidden" class="form-control" value="Suscripciones">
      <input name="email" type="text" class="form-control form-control-rounded-left" style="height: 38px;" placeholder="Ingresa un correo electrónico">
      <span class="input-group-btn">
      <button class="btn btn-default" type="submit">ENVIAR</button>
      </span>
    </div>
</form>


