<template>
  <div class="product-attribute product-sizes my-0 d-flex flex-wrap">
    <div
      @click="select(size)"
      v-for="(size, index) in sizeList"
      :key="index"
      class="rectangle d-flex justify-content-center align-items-center text-sm mx-1 cursor-pointer"
      :class="{active: isActive(size)}"
    >{{size}}</div>
  </div>
</template>

<script>
export default {
  props: {
    sizes: "",
    activeSize: null,
  },
  watch: {
    activeSize: function(newVal, oldVal) {
      // watch it
      // console.log("Active size changed: ", newVal, " | was: ", oldVal);
    }
  },
  data() {
    return {
    };
  },
  methods: {
    select(size) {
      this.$emit('on-select-size', size)
    },
    isActive(size) {
      return this.getActiveSize == size;
    },
    getSizeList() {
      return (this.sizes)
    }
  },
  computed: {
    sizeList() {
      return this.getSizeList()
    }, 
    getActiveSize() {
      return this.activeSize
    }
  },
  mounted() {

  },
};
</script>