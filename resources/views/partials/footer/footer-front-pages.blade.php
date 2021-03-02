<div class="container-fluid footer-menu ">
  <div class="row py-3">
    <div class="col-12 col-md-3">

      <div href="#" class="titulo-footer my-2">MÁS INFORMACIÓN</div>

      <div class="menu-footer-links">
        <ul class="p-0">
          @foreach (collect(setting('footer_links_column_1', []))->toArray() as $title => $link)
          <li><a href="{{ $link }}" class="text-light-grey" title="{{$title}}">{{$title}}</a></li>
          @endforeach
        </ul>
      </div>

    </div>
    <div class="col-12 col-md-3">

      <div href="#" class="titulo-footer my-2">CONTÁCTANOS</div>

      <div class="menu-footer-links">
        <ul class="p-0">
            @foreach (collect(setting('footer_links_column_2', []))->toArray() as $title => $link)
            <li><a href="{{ $link }}" class="text-light-grey" title="{{$title}}">{{$title}}</a></li>
            @endforeach
        </ul>
      </div>

    </div>
    <div class="col-12 col-md-3">

      <div href="#" class="titulo-footer my-2">VENDE Y COMPRA</div>

      <div class="menu-footer-links">
        <ul class="p-0">
            @foreach (collect(setting('footer_links_column_3', []))->toArray() as $title => $link)
            <li><a href="{{ $link }}" class="text-light-grey" title="{{$title}}">{{$title}}</a></li>
            @endforeach
        </ul>
      </div>

    </div>
    <div class="col-12 col-md-3">

      <div href="#" class="titulo-footer my-2">CONOCE MÁS</div>

      <div class="menu-footer-links">
        <ul class="p-0">
            @foreach (collect(setting('footer_links_column_4', []))->toArray() as $title => $link)
            <li><a href="{{ $link }}" class="text-light-grey" title="{{$title}}">{{$title}}</a></li>
            @endforeach
        </ul>
      </div>

    </div>

  </div>
</div>
