<div class="row">
  <div class="col">
    <h3 class="mt-2">{{ $notificationType->title }}</h3>
    <div class="row">
      <div class="form-group col-sm-6">
        <div class="form-check">
          {!! Form::hidden('settings['.$notificationType->id.'][send_email]', false) !!}
          {{-- {!! Form::checkbox('settings[{{$notificationType->id}}][send_email]',auth()->user()->getNotificationSetting($notificationType->id)->send_email,
          null, ['class' => 'form-check-input']) !!} --}}

          <input type="checkbox" class="form-check-input" name="settings[{{$notificationType->id}}][send_email]"
            value="1" @if (auth()->user()->getNotificationSetting($notificationType->id)->send_email)
          checked
          @endif
          >
          <label class="form-check-label text-primary" for="send_email">Correo electrónico</label>
        </div>
      </div>

      {{-- <div class="form-group col-sm-4">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="settings[{{$notificationType->id}}][send_sms"]>
      <label class="form-check-label text-primary" for="send_push">Mensaje de texto</label>
    </div>
  </div> --}}

  <div class="form-group col-sm-4">
    <div class="form-check">
      {!! Form::hidden('settings['.$notificationType->id.'][send_push]', false) !!}
      {{-- {!! Form::checkbox('settings[{{$notificationType->id}}][send_push]',auth()->user()->getNotificationSetting($notificationType->id)->send_push,
      null, ['class' => 'form-check-input']) !!} --}}
      <input type="checkbox" class="form-check-input" name="settings[{{$notificationType->id}}][send_push]" value="1"
        @if (auth()->user()->getNotificationSetting($notificationType->id)->send_push)
      checked
      @endif
      >
      <label class="form-check-label text-primary" for="send_push">Notificación</label>
    </div>
  </div>

  <div class="col-sm-12 form-group">
    <button class="btn btn-primary btn-block font-weight-bold">Guardar</button>
  </div>
</div>
</div>
</div>
