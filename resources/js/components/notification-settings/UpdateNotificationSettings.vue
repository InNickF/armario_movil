<template>
  <div class="row">
    <div class="col">
      <h3 class="mt-4">{{ title }}</h3>
      <div class="row">
        <div class="form-group col-sm-4">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              name="send_email"
              v-model="settings.send_email"
            />
            <label class="form-check-label text-primary" for="send_email">Correo electrónico</label>
          </div>
        </div>

        <div class="form-group col-sm-4">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              name="send_sms"
              v-model="settings.send_sms"
            />
            <label class="form-check-label text-primary" for="send_push">Mensaje de texto</label>
          </div>
        </div>

        <div class="form-group col-sm-4">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              name="send_push"
              v-model="settings.send_push"
            />
            <label class="form-check-label text-primary" for="send_push">Notificación</label>
          </div>
        </div>

        <div class="col-sm-12 form-group">
          <button class="btn btn-primary btn-block">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    settings: {
      type: Array,
      default: []
    },
    title: String
  },

  methods: {},

  mounted() {}
};
</script>