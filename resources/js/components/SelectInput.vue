<template>
  <div class="product-attribute product-sizes">
    <v-select
      v-model="data"
      :options="options"
      placeholder="Selecciona..."
      v-validate="'required'"
      class="border-white"
    ></v-select>
    <input
      type="text"
      v-model="data"
      :name="fieldName"
      :required="required"
      class="transparent position-relative"
    />
  </div>
</template>


<script>
export default {
  props: {
    fieldName: null,
    options: null,
    default: {
      type: null,
      default: null
    },
    required: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      data: null
    };
  },
  computed: {},
  mounted() {
    if (this.default) {
      this.data = this.default;
    }
  },
  methods: {}
};
</script>