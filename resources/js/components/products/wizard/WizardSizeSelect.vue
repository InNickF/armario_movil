<template>
  <div class="product-attribute product-sizes mb-3 d-flex">
    <div class="d-flex flex-wrap" v-if="sizes">
      <div
        v-for="(size, index) in getSizes"
        @click="select(size.name)"
        :key="index"
        class="rectangle d-flex justify-content-center align-items-center text-sm m-1 cursor-pointer"
        :class="{active: isActive(size.name)}"
      >{{size.name}}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    selectedSize: null,
    variantId: null,
    subsubcategoryId: null
  },
  data() {
    return {
      baseUrl: process.env.MIX_API_URL,
      sizes: []
    };
  },
  computed: {
    getSizes() {
      return this.sizes;
    }
  },
  mounted() {
    this.getProductSizes();
  },
  methods: {
    async getProductSizes() {
      var url = this.baseUrl + "/product_sizes/" + this.subsubcategoryId;

      try {
        var response = await axios.get(url);
        this.sizes = response.data.data;

        if(!this.selectedSize) {
          this.select(this.sizes[0].name);
        }

      } catch (error) {
        this.sizes = [];
      }
    },
    select(sizeName) {
      this.$emit("select-size", this.variantId, sizeName);
    },
    isActive(size) {
      return this.selectedSize == size;
    }
  }
};
</script>
