<div class="py-3 py-md-5 cont-estadisticas-home">
  <div class="container py-5">
    <div class="text-center">
      <h3 class="mt-5 text-white font-weight-bold text-uppercase">Nuestras estadísticas</h3>

      <div class="row justify-content-center mb-5 pb-4 estadisticas-txt">
        @foreach ($stats as $title => $value)
        <div class="col-md-3 col-6 text-center">
          <div class="d-flex flex-wrap flex-column justify-content-center mx-auto align-items-center my-4 datos-est">
          <h3> {{$value}}</h3>
          <p> {{$title}} </p>
        </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
