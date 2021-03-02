<template>
  <div class="product-attribute product-sizes my-3 d-flex">
    <div
      @click="select(size)"
      v-for="(size, index) in sizes"
      :key="index"
      class="rectangle d-flex justify-content-center align-items-center text-sm mx-1 cursor-pointer"
      :class="{active: isActive(size)}"
    >{{size}}</div>
    <!-- <input type="text" name="sizes" v-model="selectedSizes"> -->
  </div>
</template>

<script>
export default {
  props: {
    size: null,
    sizes: null
  },
  watch: {
    sizes: {
      handler: function(val, oldVal) {
        // If there is only one left, select it
        if (this.sizes.length == 1) {
          this.$emit("select-example-size", this.sizes[0]);
        }
      },
      deep: true
    }
  },
  methods: {
    select(size) {
      this.$emit("select-example-size", size);
    },
    isActive(size) {
      var exists = this.size == size;
      return exists;
    }
  }
};
</script>