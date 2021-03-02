<template>
  <div class="container">
    <div class="row" v-if="!loading">
      <div class="col-sm-12 col-md-12 col-lg-4">
        <outfit-images :outfit="outfit" :active-product="getActiveProduct"></outfit-images>
      </div>
      <div class="px-4 col-sm-12 col-md-12 col-lg-8 text-left">
        <div class>
          <h1 class="title text-primary text-left">{{ outfit.name }}</h1>
          <p class="desc text-primary">{{ outfit.description }}</p>
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="h-100">
              <p class="font-weight-bold text-dark-blue">Precio</p>
              <div class="bottom-wrap d-flex justify-content-start align-items-center">
                <div class>
                  <div>
                    <span class="bg-pink py-2 px-4 rounded-lg text-white">${{ outfit.makePrice() }}</span>
                  </div>
                </div>
              </div>

              <!-- Outfit Products Variants Selection -->
              <div class="mt-4 mb-2 text-sm text-bold text-dark-blue">
                <small>Elige tu color y talla preferida para cada producto</small>
              </div>

              <!-- Accordeon -->
              <div id="accordion">
                <div class="card" v-for="(product, index) in outfit.products" :key="index">
                  <div class="card-header p-0" :id="'heading' + index">
                    <h5 class="mb-0">
                      <button
                        class="btn btn-link text-primary text-sm"
                        data-toggle="collapse"
                        :data-target="'#collapse' + index"
                        aria-expanded="true"
                        :aria-controls="'collapse' + index"
                        @click="activeProduct = product"
                      >{{ product.name }}</button>
                    </h5>
                  </div>

                  <div
                    :id="'collapse' + index"
                    class="collapse"
                    :aria-labelledby="'heading' + index"
                    data-parent="#accordion"
                  >
                    <div class="card-body pt-0 bg-white">
                      <div class="my-2">
                        <color-select
                          :colors="product.colors"
                          @on-select-color="onSelectColor"
                          :active-color="product.activeColor"
                          class="mt-2 ml-0"
                        ></color-select>
                      </div>

                      <div class>
                        <size-select
                          :sizes="getProductSizes(product)"
                          @on-select-size="onSelectSize"
                          :active-size="product.activeSize"
                          class="mt-2 ml-0"
                        ></size-select>
                      </div>

                      <a :href="product.url" class="btn btn-primary btn-sm p-0 mt-2">
                        <small>Ver producto</small>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="font-weight-bold text-dark-blue mt-5 mb-1">Cantidades</div>

              <div class="d-flex align-items-center">
                <div v-if="activeVariants" class="mt-1">
                  <add-outfit-to-cart-button
                    @add-to-cart="addOutfitToCart"
                    :outfit="outfit"
                    :variants="activeVariants"
                  ></add-outfit-to-cart-button>
                </div>

                <div @click.prevent="toggleFavorite" class="cursor-pointer ml-3">
                  <div class="text-primary">
                    <i class="far fa-heart" :class="[ outfit.is_favorited ? 'fas' : '']"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="h-100">
              <div v-if="outfit.features">
                <p class="text-dark-blue font-weight-bold mb-1 mt-3 mt-md-0">Características</p>
                <ul class="text-dark-blue pl-3">
                  <li v-for="(feature, index) in outfit.features" :key="index">{{feature}}</li>
                </ul>
              </div>

              <div v-if="outfit.categories">
                <p class="text-dark-blue font-weight-bold mb-1">Categorías</p>
                <ul class="text-dark-blue pl-3">
                  <li v-for="(category, index) in outfit.categories" :key="index">{{category.name}}</li>
                </ul>
              </div>

              <div class="mt-2">
                <p class="text-dark-blue font-weight-bold mb-1">Código del outfit</p>
                <p class="text-dark-blue">{{outfit.id}}</p>
              </div>

              <div class="row mt-4">
                <div class="col-xs-6 col-md-6">
                  <p class="text-dark-blue font-weight-bold mb-1">Beneficios</p>
                  <div class="d-flex flex-wrap">
                    <a title="Entrega a domicilio">
                      <img
                        :src="baseUrl + '/images/icons/motorcicle-icon-small.svg'"
                        :alt="outfit.name"
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a title="Compras con tarjetas de crédito y débito">
                      <img
                        :src="baseUrl + '/images/icons/credit-card-icon-small.svg'"
                        :alt="outfit.name"
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a title="Primera lavada de ropa gratis">
                      <img
                        :src="baseUrl + '/images/icons/washing-machine-icon-small.svg'"
                        :alt="outfit.name"
                        class="mx-1 icon-xs"
                      />
                    </a>
                  </div>
                </div>

                <div class="col-xs-6 col-md-6 mb-4 mt-4 mt-md-0">
                  <p class="text-dark-blue font-weight-bold mb-1">Compartir</p>

                  <div class="d-flex flex-wrap">
                    <a
                      :href="'https://www.facebook.com/sharer/sharer.php?u=' + outfit.url"
                      @click="$ga.event('Outfit', 'Compartir', 'Facebook', outfit.id);"
                      target="_blank"
                    >
                      <img
                        :src="baseUrl + '/images/icons/facebook-icon-small.svg'"
                        alt
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a
                      :href="'https://pinterest.com/pin/create/button/?url=' + outfit.url + '&media=' + outfit.main_image + '&description=' + outfit.name"
                      @click="$ga.event('Outfit', 'Compartir', 'Pinterest', outfit.id);"
                      target="_blank"
                    >
                      <img
                        :src="baseUrl + '/images/icons/pinterest-icon-small.svg'"
                        alt
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a
                    :href="'https://api.whatsapp.com/send?text=' + outfit.url"
                    data-action="share/whatsapp/share"
                    @click="$ga.event('Outfit', 'Compartir', 'WhatsApp', outfit.id);"
                    target="_blank"
                  >
                    <img
                      :src="baseUrl + '/images/icons/whatsapp-icon-small.svg'"
                      alt
                      class="mx-1 icon-xs"
                    />
                  </a>

                    <!-- <a
                      :href="'https://wa.me/?text=' + outfit.url"
                      @click="$ga.event('Outfit', 'Compartir', 'WhatsApp', outfit.id);"
                      target="_blank"
                    >
                      <img
                        :src="baseUrl + '/images/icons/whatsapp-icon-small.svg'"
                        alt
                        class="mx-1 icon-xs"
                      />
                    </a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <outfit-detail-footer v-if="userId" :outfit="outfit" :userId="userId"></outfit-detail-footer> -->
    </div>
  </div>
</template>



<script>
import Outfit from "../../models/Outfit";

export default {
  components: {},
  props: {
    outfitParam: null,
    userId: null
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeProduct: null,
      outfit: Outfit,
      loading: true,
      tabIndex: 0,
      activeVariants: []
    };
  },

  computed: {
    // getOutfit() {
    //   return JSON.parse(this.outfit);
    // }
    getActiveProduct() {
      return this.activeProduct;
    }
  },
  methods: {
    // async getOutfit() {
    //   this.loading = true;
    //   var outfit = await Outfit.where("not_offline", true)
    //     .include("category", "store", "variants")
    //     .find(this.outfitId);

    //   this.outfit = outfit;

    //   this.activeColor = this.outfit.colors.length
    //     ? this.outfit.colors[0]
    //     : null;

    //   this.activeSize = this.outfit.sizes.length
    //     ? this.outfit.sizes[0]
    //     : null;

    //   this.loading = false;
    // },
    getBgImage(path) {
      let result = 'url("' + path + '")';
      return result;
    },
    onSelectColor(color) {
      Vue.set(this.getActiveProduct, "activeColor", color);
      Vue.set(
        this.getActiveProduct,
        "activeSize",
        this.getProductSizes(this.getActiveProduct)[0]
      );
      this.$forceUpdate();
      this.updateActiveVariants();
    },
    onSelectSize(size) {
      Vue.set(this.getActiveProduct, "activeSize", size);
      this.$forceUpdate();
      this.updateActiveVariants();
    },
    addOutfitToCart(data) {
      // * comes from addToCartButton with {outfit:outfit, qty:quantity, variant: variant}
      this.$emit("on-add-to-cart", data);
    },
    async toggleFavorite() {
      try {
        var response = await axios.get(
          this.apiUrl + "/outfits/" + this.outfit.id + "/favorite"
        );
        response = response.data.data;

        this.outfit.is_favorited = !this.outfit.is_favorited;

        this.$root.displayToast({
          image_url: this.outfit.main_image_thumbnail,
          title: this.outfit.name,
          body: this.outfit.is_favorited
            ? "Se ha agregado correctamente los artículos del outfit a tu wishlist"
            : "Se ha eliminado correctamente los artículos del outfit de tu wishlist",
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
        this.$root.displayInfo(error.response.data.message);
      }
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
      return sizes;
    },
    updateActiveVariants() {
      let variants = [];

      this.outfit.products.forEach(p => {
        let variant = p.variants.find(
          v => v.color == p.activeColor && v.size == p.activeSize
        );

        variants.push(variant);
      });

      this.activeVariants = variants;
    }
  },
  mounted() {
    this.outfit = new Outfit(this.outfitParam);

    // * Set default product and default active color
    this.outfit.products.forEach(p => {
      p.activeColor = p.colors[0];
      p.activeSize = this.getProductSizes(p)[0];
    });
    this.updateActiveVariants();
    this.loading = false;
  }
};
</script>
