<template>
  <div v-if="!loading" class="product-card">
    <a :href="productFinal.url">
      <div class="d-flex">
        <div class="card-image position-relative w-50">
          <div
            :style="{backgroundImage: getBgImage(productFinal.main_image_thumbnail)}"
            class="bg-center bg-cover w-100 h-100"
          ></div>
          <!-- <img :alt="productFinal.name" :src="productFinal.main_image_thumbnail" /> -->

          <div class="position-absolute top-0 left-0">
            <div
              class="h6 bg-pink mx-auto text-white text-center mt-4 en-oferta-pin px-3"
              v-if="productFinal.has_discount"
            >OFERTA</div>
          </div>
        </div>
        <div class="card-body position-relative">
          <h3
            class="card-title mt-4 mb-0"
          >{{ productFinal.name.length > 18 ? productFinal.name.substring(0, 15) + '...' : productFinal.name }}</h3>
          <a
            class="card-subtitle text-sm text-bold text-primary"
            :href="productFinal.store.url"
          >by {{ productFinal.store.name.length > 18 ? productFinal.store.name.substring(0, 15) + '...' : productFinal.store.name }}</a>
          <div class="card-text">
            <div class="price-wrap my-3">
              <div>
                <span class="price-new text-bold">{{productFinal.final_price.toFixed(2)}}</span>
              </div>
              <div v-if="productFinal.has_discount">
                <del class="price-old text-muted">{{productFinal.price.toFixed(2)}}</del>
              </div>
            </div>
          </div>
          <div class="position-absolute bottom-0 pr-3 mb-2">
            <div class="d-flex align-items-center">
              <div>
                <a :href="productFinal.url" class="link-btn">
                  <p class="text-underline text-sm mb-0"><small>Ver producto></small></p>
                </a>
              </div>
              <div @click.prevent="toggleFavorite" class="cursor-pointer ml-3">
                <div class="text-primary">
                  <i class="far fa-heart" :class="[ productFinal.is_favorited ? 'fas' : '']"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>



<script>
import Product from "../../models/Product";

export default {
  components: {},
  props: {
    product: null
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeColor: null,
      activeSize: null,
      loading: true,
      productFinal: Product
    };
  },

  computed: {
    // getProduct() {
    //   return JSON.parse(this.product);
    // }
  },
  methods: {
    async toggleFavorite() {
      try {
        var response = await axios.get(
          this.apiUrl + "/products/" + this.productFinal.id + "/favorite"
        );
        response = response.data.data;

        this.productFinal.is_favorited = !this.productFinal.is_favorited;

        this.$root.displayToast({
          image_url: this.productFinal.main_image_thumbnail,
          title: this.productFinal.name,
          body: this.productFinal.is_favorited
            ? "Se ha agregado correctamente un artículo a tu wishlist"
            : "Se ha eliminado correctamente un artículo de tu wishlist",
          link: this.baseUrl + "/account/wishlist"
        });

        if (this.productFinal.is_favorited) {
          this.$ga.event(
            "Producto",
            "Preguntas / Wishlist",
            this.productFinal.name,
            this.productFinal.id
          );
        }
      } catch (error) {
        this.$root.displayInfo(error.response.data.message);
      }
    },
    getBgImage(image) {
      let result = 'url("' + image + '")';
      return result;
    }
  },
  mounted() {
    // console.log("SingleProductSmall mounted.", this.productId);
    // this.getProduct();
    if (this.product) {
      this.productFinal = new Product(this.product);
      // console.log('Product', this.productFinal);
      this.loading = false;
    }

    // if (this.oldReview) {
    //   this.review = this.oldReview;
    // }
  }
};
</script>
