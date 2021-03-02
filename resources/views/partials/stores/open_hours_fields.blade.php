

<div class="col-12 p-0">
  @foreach ($days as $key => $day)
  <div class="row my-3 d-flex">
    <div class="form-group col-md-4 col-12">
      <div class="form-check pl-1 abc-checkbox abc-checkbox-primary">
        <input type="checkbox" aria-label="Abierto en este día" name="open_hours[{{$key}}][is_open]" {{$user->store->getOpenHoursRanges() && $user->store->getOpenHoursRanges()->isOpenOn($key) ? 'checked' : ''}} class="form-check-input radio-custom checkbox">
          <label
              class="radio-custom-label"
              for="is_primary"
              id="is_primary"
            ><small class="ml-2">{{$day}}</small></label>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="row d-flex align-items-center">
          <div class="col-md-6">

          <select-input class="w-100" field-name="open_hours[{{$key}}][open_hour]" :default="{{ $user->store->getDayRange($key) ? json_encode($user->store->getDayRange($key)['start']) : '[]' }}" :options="{{json_encode($hours)}}" :required="false"></select-input>

            {{-- <select name="open_hours[{{$key}}][open_hour]" class="form-control">
              @include('partials.stores.hours-dropdown', ['old' => ])
            </select> --}}
            {{-- <input type="text" class="form-control" name="open_hours[{{$key}}][open_hour]"> --}}
          </div>
          <div class="col-md-6">
             <select-input class="w-100" field-name="open_hours[{{$key}}][close_hour]" :default="{{ $user->store->getDayRange($key) ? json_encode($user->store->getDayRange($key)['end']) : '[]' }}" :options="{{json_encode($hours)}}" :required="false"></select-input>


              {{-- <select name="open_hours[{{$key}}][close_hour]" class="form-control">
                  @include('partials.stores.hours-dropdown', ['old' => $user->store->getDayRange($key) ? $user->store->getDayRange($key)['end'] : ''])
              </select> --}}
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
