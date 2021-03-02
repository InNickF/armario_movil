@foreach ($hours as $hour)
<option value="{{$hour}}" {{!empty($old) && $old == $hour ? 'selected="selected"' : ''}}>{{$hour}}</option>
@endforeach