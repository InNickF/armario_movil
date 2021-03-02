<template>
  <div class="cont-cart">
    <div class="bg-white">
      <ul class="list-group">
        <div v-if="wishlist.length" class="row">
          <div
            class="col-lg-4 col-md-6 my-3 card-deck"
            v-for="(product, index) in wishlist"
            :key="index"
          >
            <div class="card card-account my-3">
              <wishlist-product :product="product" @on-add-to-cart="$root.addProductToCart"></wishlist-product>
            </div>

            <button
              type="button"
              class="btn-close-cart m-2 position-absolute close-button-wishlist"
              @click="removeFavorite(product)"
            >
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>

        <li
          class="list-group-item mb-2 no-border text-primary w-100 text-center my-5 py-5"
          v-if="!wishlist || !wishlist.length"
        >Al momento no tienes productos en tu lista de deseados</li>
      </ul>
    </div>
  </div>
</template>


<script>
export default {
  async mounted() {
    this.wishlist = this.wishlistProp;
  },
  methods: {
    async removeFavorite(product) {
      try {
        var response = await axios.get(
          this.apiUrl + "/products/" + product.id + "/favorite"
        );
        response = response.data.data;

        this.wishlist = this.wishlist.filter(p => p.id != product.id);
      } catch (error) {
        this.$root.displayInfo(error.response.data.message);
      }
    },
    onSelectColor(product, color) {
      product.activeColor = color;
    },
    onSelectSize(product, size) {
      product.activeSize = size;
    },
    getProductSizes(product) {
      let sizes = product.sizes;
      if (!product.activeColor) {
        return null;
      }

      sizes = product.variants
        .filter(v => v.color == product.activeColor)
        .map(v => v.size)
        .filter((value, index, self) => self.indexOf(value) === index);

      if (sizes.length) product.activeSize = sizes[0];
      return sizes;
    },
    activeVariant(product) {
      return product.variants.find(
        v => v.color == product.activeColor && v.size == product.activeSize
      );
    },
    addProductToCart(data) {
      // comes from addToCartButton with {product:product, qty:quantity, variant: variant}
      this.$emit("on-add-to-cart", data);
    }
  },
  data() {
    return {
      apiUrl: process.env.MIX_API_URL,
      wishlist: []
    };
  },
  props: {
    wishlistProp: null
  },
  computed: {}
};
</script>
