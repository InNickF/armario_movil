<div class="card-product h-100">
  <a href="{{$outfit->url }}">

    <img class="card-img-top img-fluid  mx-auto d-block p-3" src="{{ $outfit->main_image_thumbnail }}">

    <div class="card-body">
      <a href="{{$outfit->url }}">
        <span class="text-md title card-title">{{ $outfit->name}}</span>
      </a>

      <p class="mt-2 card-text text-sm">
        {{$outfit->description }}
      </p>

    </div>
    <div class="card-footer card-footer-account">
      <div class="card-text bottom-wrap d-flex flex-wrap justify-content-start align-items-center">
        <div class="price-wrap font-weight-bold text-primary h4">
          @if ($outfit->has_discount)
          <span class="'price text-primary h4 font-weight-bold color-' + priceColor">@money($outfit->price)</span>
          <del class="price-old">@money($outfit->price)</del>
          @else
          <span class="'price text-bold h4 color-' + priceColor">@money($outfit->price)</span>
          @endif
        </div>

        <!-- price-wrap.// -->
        <!--<div class>-->
          <!--<button class="btn text-danger">-->
            <!--<i class="fa fa-heart"></i>-->
            <!--</button>-->
            <!--</div>-->
          </div>
                      <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('account.outfits.edit', $outfit->id)}}" class="btn btn-primary btn-sm font-weight-bold btn-block">Editar</a>
                      </div>
    </div>


  </a>
</div>
