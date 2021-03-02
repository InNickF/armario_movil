<template>
  <div class="w-xl-100">
    <datetime
      value-zone="America/Guayaquil"
      :placeholder="label"
      zone="America/Guayaquil"
      v-model="date"
      input-class="form-control w-xl-100 pt-2"
      :phrases="{ok: 'Aceptar', cancel: 'Cancelar'}"
    ></datetime>
    <input
      type="text"
      v-model="date"
      :name="fieldName"
      :required="required ? true : false"
      class="transparent"
    />
  </div>
</template>

<script>
export default {
  /*
   * The component's data.
   */
  data() {
    return {
      date: ""
    };
  },

  props: {
    fieldName: "",
    oldValue: null,
    setDefault: true,
    label: "",
    required: {
      type: null,
      default: null
    }
  },

  computed: {},

  mounted() {
    if (this.oldValue && this.oldValue.length) {
      let dateFormatted = this.oldValue.replace(/-/g, "/");
      let dateObj = new Date(dateFormatted);
      this.date = dateObj.toISOString(); //'2018-05-12T17:19:06.151Z'
    } else {
      if (this.setDefault) {
        this.date = Vue.time(Date.now())
          .subtract(18, "years")
          .toISOString();
      }
    }
  }
};
</script>