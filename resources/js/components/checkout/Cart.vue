<template>
  <div class="bg-white">
    <ul class="list-group">
      <li
        class="list-group-item mb-2 bg-light no-border"
        v-for="(product, index) in $parent.$parent.cart.products"
        :key="index"
      >
        <div class="row d-flex flex-wrap align-items-center">
          <div class="col-md-3">
            <a :href="product.attributes.variant.product.url">
              <div
                class="avatar-md mx-auto rounded-circle mx-3 my-3 bg-center bg-cover bg-no-repeat"
                :style="{backgroundImage: getProductBgImage(product.attributes)}"
              ></div>
            </a>
          </div>

          <div class="col-md-3">
            <a :href="product.attributes.variant.product.url">
              <div class="text-primary h5">{{product.name}}</div>
            </a>

            <div class="price-wrap">
              <span
                class="price-new h2 text-primary"
              >${{ product.price_sum }}</span>
              <!-- <del
                v-if="hasDiscount(product)"
                class="price-old text-muted priceold-prod-car"
              >${{ product.price_sum }}</del> -->
            </div>
            <!-- <div
              class="d-flex justify-content-between"
              v-for="(condition, index) in product.conditions"
              :key="index"
            >
              <div>
                <p class="mb-0">Cupón {{condition.args.name}}</p>
              </div>
              <span>
                <span v-if="condition.args.type == 'coupon'">-</span>
                ${{condition.parsedRawValue}}
              </span>
            </div> -->
          </div>

          <div class="col-md-6 d-flex flex-wrap justify-content-around">
            <div class="product-attribute product-colors">
              <p class="titulos-cart">Color:</p>
              <div class="circle mx-1 d-flex justify-content-center align-items-center">
                <div
                  class="color-circle"
                  :style="{backgroundColor: product.attributes.variant.color}"
                ></div>
              </div>
            </div>

            <div>
              <div class="product-attribute product-sizes">
                <p class="titulos-cart">Talla:</p>
                <div
                  class="rectangle d-flex justify-content-center align-items-center text-sm mx-1"
                >{{product.attributes.variant.size}}</div>
              </div>
            </div>

            <div class>
              <p class="titulos-cart">Cantidades:</p>
              <div class>
                <div class="btn-group cont-cantidades mb-3" role="group" aria-label="Basic example">
                  <button
                    type="button"
                    class="btn btn-md bg-grey text-dark btn-cantidades"
                    @click="decreaseQuantity(product)"
                  >
                    <i class="fa fa-minus"></i>
                  </button>

                  <label class="quantity-label text-bold pt-2">{{product.quantity}}</label>
                  <button
                    type="button"
                    class="btn btn-md bg-grey text-dark btn-cantidades"
                    @click="increaseQuantity(product)"
                  >
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button
          type="button"
          class="border-none m-2 position-absolute top-0 right-0 bg-transparent"
          @click="removeProduct(product)"
        >
          <i class="far fa-times-circle"></i>
        </button>
      </li>
    </ul>
  </div>
</template>




<script>
export default {
  async mounted() {
    this.$parent.$emit("get-cart");
  },
  methods: {
    getProductCount() {
      return this.$parent.$parent.cart.count;
    },
    increaseQuantity(product) {
      if (product.quantity < product.attributes.quantity) {
        this.$parent.$emit("increase-quantity", product);
      }
    },
    decreaseQuantity(product) {
      if (product.quantity > 1) {
        this.$parent.$emit("decrease-quantity", product);
      }
    },
    removeProduct(product) {
      this.$parent.$emit("remove-product", product);
    },
    getProductBgImage(product) {
      let result = 'url("' + product.image + '")';
      return result;
    },
    hasDiscount(product) {
      return product.price_sum_with_conditions < product.price_sum;
    }
    // async getCart() {
    //   var response = await axios.get(process.env.MIX_API_URL + "/cart");
    //   this.cart = response.data;
    //   console.log('Cart: ', this.cart);
    // },
  },
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL
    };
  }
};
</script>
