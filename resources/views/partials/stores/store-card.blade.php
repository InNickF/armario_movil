<div class="card mb-4">
    <div class="card-body justify-content-center align-content-center d-flex" style="min-height:215px!important;">
        <div class="d-flex align-items-center w-100">
    <div class="img-fluid">
        <a href="{{ $store->url }}">
            <img class="avatar-md rounded-circle mx-3 mt-3 bg-white" src="{{ $store->logo_image }}">
        </a>
        @if ($store->is_official)
         <p class="text-center text-secondary text-xs mt-3 mb-0"><i class="fa fa-check"></i> Armario oficial</p>
        @endif
    </div>

    <div>
        <a href="{{ $store->url }}">
            <p class="my-2 text-primary">{{ $store->name }}</p>
        </a>
        @include('partials.stores.rating', ['theme' => 'light'])


        {{-- <div>{{$store->address->city}}</div> --}}

        <div>
            <p class="text-sm mt-2 text-primary">Horario de envío:
                <br>
                <i class="fa fa-clock text-primary"></i> 

                @if ($store->today_range)
                {{$store->today_range}}
                @elseif($store->is_always_open)
                24 horas
                @else
                Cerrado
                @endif

            </p>
      


        </div>
    </div>
</div>
    </div>
</div>