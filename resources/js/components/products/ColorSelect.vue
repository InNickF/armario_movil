<template>
  <div class="product-attribute product-colors my-0 d-flex">
    <div
      @click="select(color)"
      v-for="(color, index) in colorList"
      :key="index"
      class="circle mx-1 d-flex justify-content-center align-items-center cursor-pointer bg-transparent"
      :class="{active: isActive(color)}"
    >
      <div class="color-circle" :style="{backgroundColor: color}"></div>
    </div>
      <input ref="activeColorField" type="hidden" v-model="activeColor">
  </div>
</template>

<script>
export default {
  props: {
    colors: "",
    activeColor: null
  },
   watch: {
    activeColor: function(newVal, oldVal) {
      // watch it
      // console.log("Active color changed: ", newVal, " | was: ", oldVal);
    }
  },
  data() {
    return {
    };
  },
  methods: {
    select(color) {
      this.$emit('on-select-color', color)
    },
    isActive(color) {
      return this.activeColor == color;
    },
     getColorList() {
      return (this.colors)
    }
  },
  computed: {
    colorList() {
      return this.getColorList()
    }
  },
  mounted() {
    // console.log('init color select');
  },
};
</script>