<template>
  <div v-if="finalOutfit" class="card-product card-outfit h-100">
    <a :href="finalOutfit.url">
      <div class="card-img-top img-fluid d-block my-3 px-3">
        <div
          class="bg-center bg-cover bg-no-repeat outfit-card-img rounded"
          :style="{backgroundImage: getProductBgImage(finalOutfit.main_image_thumbnail)}"
        ></div>
      </div>

      <div class="card-body text-left">
        <a :href="finalOutfit.url">
          <span class="text-md title card-title">{{ finalOutfit.name }}</span>
        </a>

        <p
          style="font-size:0.9rem;"
          class="text-bold mt-2 card-text"
          v-if="finalOutfit.store"
        >by {{finalOutfit.store.name}}</p>

        <!-- Plan: {{finalOutfit.store ? finalOutfit.store.address.city : '?'}} -->
        <!--<p>-->
        <!--Categorías:-->
        <!--<small-->
        <!--v-for="(category, index) in finalOutfit.categories"-->
        <!--:key="index"-->
        <!--&gt;{{ category.name }}</small>-->
        <!--</p>-->
      </div>

      <div class="card-footer">
        <div class="card-text bottom-wrap d-flex justify-content-between align-items-center">
          <div class="price-wrap">
            <span :class="'price font-weight-bold h5'">$ {{ finalOutfit.makePrice() }}</span>
          </div>

          <div @click.prevent="toggleFavorite" class="cursor-pointer">
            <div class="text-primary">
              <i class="far fa-heart" :class="[ finalOutfit.is_favorited ? 'fas' : '']"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- bottom-wrap.// -->
    </a>
  </div>
</template>

<script>
import Outfit from "../../models/Outfit";

export default {
  components: {},
  props: {
    outfit: null
  },
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      finalOutfit: null
    };
  },
  methods: {
    getProductBgImage(image) {
      let result = 'url("' + image + '")';
      return result;
    },
    async toggleFavorite() {
      try {
        var response = await axios.get(
          this.apiUrl + "/outfits/" + this.finalOutfit.id + "/favorite"
        );
        response = response.data.data;

        this.finalOutfit.is_favorited = !this.finalOutfit.is_favorited;

        this.$root.displayToast({
          image_url: this.finalOutfit.main_image_thumbnail,
          title: this.finalOutfit.name,
          body: this.finalOutfit.is_favorited
            ? "Se han agregado los artículos de este conjunto a tu wishlist"
            : "Se han eliminado correctamente los artículos de tu wishlist",
          link: this.baseUrl + "/account/wishlist"
        });

        if (this.finalOutfit.is_favorited) {
          this.$ga.event(
            "Outfit",
            "Preguntas / Wishlist",
            this.finalOutfit.name,
            this.finalOutfit.id
          );
        }
      } catch (error) {
        this.$root.displayError(error.response.data.message);
      }
    }
  },
  computed: {},

  mounted() {
    if (typeof this.outfit == "Outfit") {
      this.finalOutfit = this.outfit;
    } else {
      this.finalOutfit = new Outfit(this.outfit);
    }
  }
};
</script>