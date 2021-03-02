<template>
  <div class="card-product card-product--no-hover h-100 shadow-sm">
    <div class>
      <a :href="product.url">
        <div
          class="img-lg mx-auto mx-3 bg-center bg-cover bg-no-repeat"
          :style="{backgroundImage: getProductBgImage(product)}"
        ></div>
      </a>
    </div>
    <div class="card-body px-2 py-3">
      <div class="d-flex">
        <a class="col-8 pl-0" :href="product.url">
          <h3 class="text-md text-primary">{{product.name}}</h3>
        </a>
        <div class="col-4 pr-0 pl-0">
          <div v-if="product.has_discount">
            <span
              class="font-weight-bold text-primary h4 col-4 pr-0"
            >${{ product.final_price.toFixed(2) }}</span>
            <del class="price-old text-muted">{{ product.price.toFixed(2) }}</del>
          </div>

          <span
            v-else
            class="font-weight-bold text-primary h4"
          >${{ product.final_price.toFixed(2) }}</span>
        </div>
      </div>

      <div
        class="mt-2 mt-md-0 mb-2 text-dark-blue mb-1 font-weight-bold"
      >Escoge tu color y talla preferida</div>
      <div class="mb-2">
        <color-select
          :colors="product.colors"
          @on-select-color="onSelectColor"
          :active-color="activeColor"
        ></color-select>
      </div>
      <div class="mt-1 mb-3">
        <size-select
          :sizes="getProductSizes"
          @on-select-size="onSelectSize"
          :active-size="activeSize"
        ></size-select>
      </div>

      <div class="font-weight-bold text-sm text-dark-blue mt-1 mb-1">Cantidades</div>
      <div class="d-flex align-items-center">
        <add-to-cart-button
          @add-to-cart="addProductToCart"
          :product="product"
          :variant="activeVariant"
        ></add-to-cart-button>
      </div>
    </div>
  </div>
</template>

<!-- REEMPLAZAR LA IMAGEN CON: 
    <a :href="product.url">
      <img class="card-img-top img-fluid mx-auto d-block p-0" :src="$product.main_image"/>
    </a> -->


<script>
import Product from "../../models/Product";

export default {
  components: {},
  props: {
    product: Object
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeSize: null,
      activeColor: null,
      loading: true
    };
  },

  watch: {
    product: {
      deep: true,
      immediate: true,
      handler: function(val, oldVal) {
        // Reset to default variant
        this.activeColor = val.colors.length ? val.colors[0] : null;
        this.activeSize = val.sizes.length ? val.sizes[0] : null;
      }
    }
  },

  computed: {
    // getProduct() {
    //   return JSON.parse(this.product);
    // }
    getProductSizes() {
      let sizes = this.product.sizes;
      if (!this.activeColor) {
        return null;
      }

      sizes = this.product.variants
        .filter(v => v.color == this.activeColor)
        .map(v => v.size)
        .filter((value, index, self) => self.indexOf(value) === index);

      if (sizes.length) this.activeSize = sizes[0];
      return sizes;
    },
    activeVariant() {
      let variant = this.product.variants.find(
        v => v.color == this.activeColor && v.size == this.activeSize
      );
      return variant;
    }
  },
  methods: {
    // async getProduct() {
    //   this.loading = true;
    //   var product = await Product.where("not_offline", true)
    //     .include("category", "store", "variants", "outfits")
    //     .find(this.productId);

    //   this.product = product;

    //   this.activeColor = this.product.colors.length
    //     ? this.product.colors[0]
    //     : null;

    //   this.activeSize = this.product.sizes.length
    //     ? this.product.sizes[0]
    //     : null;

    //   this.loading = false;
    // },
    getBgImage(path) {
      let result = 'url("' + path + '")';
      return result;
    },
    getProductBgImage(product) {
      let result = 'url("' + product.main_image_thumbnail + '")';
      return result;
    },
    onSelectColor(color) {
      this.activeColor = color;
    },
    onSelectSize(size) {
      this.activeSize = size;
    },
    addProductToCart(data) {
      // comes from addToCartButton with {product:product, qty:quantity, variant: variant}
      this.$emit("on-add-to-cart", data);
    }
  },
  mounted() {
    this.activeColor = this.product.colors.length
      ? this.product.colors[0]
      : null;

    this.activeSize = this.product.sizes.length ? this.product.sizes[0] : null;
    // console.log("SingleProduct mounted.", this.productId);
    // this.getProduct();
    // if (this.product) {
    //   this.product = JSON.parse(this.product)
    // }
    // if (this.oldReview) {
    //   this.review = this.oldReview;
    // }
  }
};
</script>
