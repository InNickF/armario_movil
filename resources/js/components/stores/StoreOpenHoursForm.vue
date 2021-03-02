<template>
  <div>
    <!-- Schedule Field -->
    <div
      class="mb-2 h6 text-primary mt-4 font-weight-bold"
    >Horario para despachos de producto a clientes:</div>

    <div class="d-flex justify-content-center">
      <div class="form-check abc-checkbox abc-checkbox-primary mx-3 col-6 mb-1">
        <input
          class="radio-custom"
          type="radio"
          name="is_always_open"
          id="is_always_open"
          value="0"
          v-model="isAlwaysOpen"
        />
        <label class="radio-custom-label" for="is_always_open">
          <small class="ml-2">Abierto según horario</small>
        </label>
      </div>

      <div class="form-check abc-checkbox abc-checkbox-primary mx-3 col-6">
        <input
          class="radio-custom"
          type="radio"
          name="is_always_open"
          id="is_always_open2"
          value="1"
          v-model="isAlwaysOpen"
        />
        <label class="radio-custom-label" for="is_always_open2">
          <small class="ml-2">Abierto las 24 horas</small>
        </label>
      </div>
    </div>

    <div class="mx-3" v-show="getIsOpen == '0'">
      <slot></slot>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    isAlwaysOpenProp: true
  },
  mounted() {
    this.isAlwaysOpen = this.isAlwaysOpenProp;
  },
  data() {
    return {
      isAlwaysOpen: null
    };
  },
  computed: {
    getIsOpen() {
      return this.isAlwaysOpen;
    }
  }
};
</script>