<div class="container mt-3">
  <div class="row">
    @foreach ($categories as $category)
    <div class="col-md-4">
      <div class="mb-2">

        <div class="card card-product rounded-md-3 min-height-300 d-flex justify-content-center align-items-center">
          <div class="rounded-md-3">
            <div class="card-body text-center ">
              <a href="{{ url('/preguntas-frecuentes/categorias/' . $category->slug) }}" class="text-center">
                <img src="{{ $category->icon_image }}" alt="" class="img-md-3 mb-3 image-svg cat-icon">
                <div class="title h2">{{ $category->name }}</div>
                <p class="">{{ $category->description }}</p>
              <a/>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
