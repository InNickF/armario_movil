<template>
  <div v-if="finalProduct" class="card-product h-100">
    <a :href="finalProduct.url">
      <div class="position-relative">
        <div class="p-3">
          <div
            :style="{backgroundImage: getBgImage(finalProduct.main_image_thumbnail)}"
            class="card-img-top img-fluid d-block bg-cover bg-center"
            :alt="finalProduct.name"
            style="height:350px;"
          ></div>
        </div>
        <div class="position-absolute top-0 left-0">
          <div
            class="bg-pink mx-auto text-white text-center mt-4 en-oferta-pin px-4"
            v-if="finalProduct.has_discount"
          >OFERTAS</div>
        </div>
      </div>

      <div class="card-body text-left">
        <a :href="finalProduct.url">
          <span
            class="text-md title card-title"
          >{{ finalProduct.name.length > 24 ? finalProduct.name.substring(0, 20) + '...' : finalProduct.name }}</span>
        </a>

        <p class="text-bold mt-2 card-text" v-if="finalProduct.store">by {{finalProduct.store.name}}</p>

        <!-- Plan: {{finalProduct.store ? finalProduct.store.address.city : '?'}} -->
        <!--<p>-->
        <!--Categorías:-->
        <!--<small-->
        <!--v-for="(category, index) in finalProduct.categories"-->
        <!--:key="index"-->
        <!--&gt;{{ category.name }}</small>-->
        <!--</p>-->
      </div>

      <div class="card-footer">
        <div class="card-text bottom-wrap d-flex justify-content-between align-items-center">
          <div class="price-wrap">
            <span
              v-if="finalProduct.has_discount"
              :class="'price text-bold h5 text-pink-2 font-weight-bold mr-3'"
            >$ {{ finalProduct.makeFinalPrice() }}</span>

            <span
              v-if="!finalProduct.has_discount"
              :class="'price font-weight-bold text-bold h5 color-' + priceColor"
            >$ {{ finalProduct.makeFinalPrice() }}</span>
            <del
              v-if="finalProduct.has_discount"
              class="price-old price text-primary-transparency font-weight-bold"
            >{{finalProduct.makePrice() }}</del>
          </div>

          <div @click.prevent="toggleFavorite" class="cursor-pointer">
            <div class="text-primary">
              <i
                class="far fa-heart whishlist-white"
                :class="[ finalProduct.is_favorited ? 'fas' : '']"
              ></i>
            </div>
          </div>
        </div>
      </div>

      <!-- bottom-wrap.// -->
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
      finalProduct: null
    };
  },
  methods: {
    async toggleFavorite() {
      try {
        var response = await axios.get(
          this.apiUrl + "/products/" + this.finalProduct.id + "/favorite"
        );
        response = response.data.data;

        this.finalProduct.is_favorited = !this.finalProduct.is_favorited;

        this.$root.displayToast({
          image_url: this.finalProduct.main_image_thumbnail,
          title: this.finalProduct.name,
          body: this.finalProduct.is_favorited
            ? "Se ha agregado correctamente el artículo a tu wishlist"
            : "Se ha eliminado correctamente el artículo de tu wishlist",
          link: this.baseUrl + "/account/wishlist"
        });

        if (this.finalProduct.is_favorited) {
          this.$ga.event(
            "Producto",
            "Preguntas / Wishlist",
            this.finalProduct.name,
            this.finalProduct.id
          );
        }
      } catch (error) {
        this.$root.displayInfo(error.response.data.message);
      }
    },
    getBgImage(mediaItem) {
      // console.log(this.activeImageKey);
      let result = 'url("' + mediaItem + '")';
      // console.log(result);
      return result;
    }
  },
  computed: {
    priceColor: function() {
      // var d = new Date();
      // d.setDate(d.getDate() - 1);
      // ! Inactive functionality
      // if (this.finalProduct.condition == "Nuevo") {
      //   return "new";
      // }

      return "normal";
    }
  },

  mounted() {
    if (typeof this.product == "Product") {
      this.finalProduct = this.product;
    } else {
      this.finalProduct = new Product(this.product);
    }
  }
};
</script>