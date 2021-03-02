<b-popover target="hoursPopover" triggers="hover focus" placement="bottom">

  <div class="d-flex align-items-center mt-1">
    <div id="hoverShowSchedule" class="text-sm text-white">
      <div class="h5 mt-0 text-sm">Horarios de envío:</div>
      <div class="text-sm d-flex justify-content-start my-2">


        @if ($store->getDayRange('monday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Lunes:</div>
            <div>{{$store->getDayRange('monday')['start']}}h - {{$store->getDayRange('monday')['end']}}h</div>
          </small>
        </div>
        @endif

        @if ($store->getDayRange('tuesday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Martes:</div>
            <div> {{ $store->getDayRange('tuesday')['start']}}h - {{$store->getDayRange('tuesday')['end']}}h
            </div>
          </small>
        </div>
        @endif
      </div>
      <div class=" text-sm d-flex justify-content-between my-2">
        @if ($store->getDayRange('wednesday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Miércoles:</div>
            <div>{{$store->getDayRange('wednesday')['start']}}h - {{$store->getDayRange('wednesday')['end']}}h
            </div>
          </small>
        </div>
        @endif

        @if ($store->getDayRange('thursday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Jueves:</div>
            <div>{{$store->getDayRange('thursday')['start']}}h - {{$store->getDayRange('thursday')['end']}}h
            </div>
          </small>
        </div>
        @endif
      </div>

      <div class=" text-sm d-flex justify-content-between my-2">
        @if ($store->getDayRange('friday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Viernes: </div>
            <div> {{$store->getDayRange('friday')['start']}}h - {{$store->getDayRange('friday')['end']}}h
            </div>
        </div>
        </small>
        @endif

        @if ($store->getDayRange('saturday'))
        <div class="d-block mx-2">
          <small>
            <div class="">Sábado:</div>
            <div> {{$store->getDayRange('saturday')['start']}}h - {{$store->getDayRange('saturday')['end']}}h
            </div>
        </div>
        </small>
        @endif
      </div>

      <div class="text-sm d-flex justify-content-between my-2">
        <div class="b-block mx-2">
            <small>
                @if ($store->getDayRange('sunday'))
                <div class="">Domingo:</div>
                <div> {{$store->getDayRange('sunday')['start']}}h - {{$store->getDayRange('sunday')['end']}}h
                </div>
                @endif
            </small>
        </div>

      </div>
    </div>

  </div>
</b-popover>
