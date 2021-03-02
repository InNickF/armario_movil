<template>
  <div class="container">
    <div class="row" v-if="!loading">
      <div class="col-md-5 mx-auto">
        <a :href="product.url">
          <product-images
            :is-active-slide="isActiveSlide"
            :product="productFinal"
            :active-color="activeColor"
            :key="'scroll-'+productFinal.id"
          ></product-images>
        </a>
      </div>
      <div class="px-4 col-md-6 text-left mt-5 mt-md-0">
        <div class="row">
          <div class="d-md-flex align-items-center mx-auto ml-md-0">
            <div class="img-fluid text-center">
              <a :href="product.store.url">
                <img
                  :alt="product.name"
                  class="avatar-md rounded-circle mx-3"
                  :src="product.store.logo_image_thumbnail"
                />
              </a>
            </div>

            <div class="text-center text-md-left">
              <a :href="product.store.url">
                <p class="my-2 text-primary">{{ product.store.name }}</p>
              </a>
              <div class="d-flex star-rating-sm justify-content-center justify-content-md-start">
                <img
                  v-for="(star, index) in product.store.rating"
                  :key="index"
                  :src="baseUrl + '/images/rating/bag-' + star + '.png'"
                  :alt="product.name"
                  class="mx-1"
                />
              </div>

              <div>
                <p v-if="product.store.today_range" class="text-sm mt-2 text-primary mb-0">
                  Horario de envío:
                  <br />
                  <i class="fa fa-clock text-primary"></i>
                  {{product.store.today_range}}
                </p>
                <p v-else class="text-sm mt-2 text-primary">
                  Horario de envío:
                  <br />
                  <i class="fa fa-clock text-primary"></i> 24 horas
                </p>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-12 mt-2">
                <p v-if="product.store.is_official" class="text-left text-pink text-xs ml-1">
                  <i class="fa fa-check"></i> Armario oficial
                </p>
              </div>
            </div>
          </div>

          <article class="px-4 pt-0">
            <span
              v-if="product.outfits && product.outfits.length"
              class="badge badge-secondary text-sm"
            >En outfit</span>
            <a :href="product.url">
              <h3 class="title mb-4 text-primary">{{ productFinal.name }}</h3>
            </a>

            <div class="mb-4">
              <div class="price h3">
                <div class="mt-2">
                  <div class>
                    <div v-if="productFinal.has_discount">
                      <span
                        class="bg-pink py-2 px-4 rounded-lg text-white"
                      >${{ productFinal.makeFinalPrice() }}</span>
                      <del
                        class="price-old text-muted text-sm font-weight-bold ml-3"
                      >{{ productFinal.makePrice() }}</del>
                    </div>

                    <span
                      v-else
                      class="bg-pink py-2 px-4 rounded-lg text-white"
                    >${{ productFinal.makeFinalPrice() }}</span>
                  </div>
                </div>
                <!-- price-wrap.// -->
              </div>
            </div>
            <!-- price-detail-wrap .// -->

            <div>
              <!-- ! Inactive functionality -->
              <!-- <p class="text-primary">Producto {{productFinal.condition}}</p> -->
              <color-select
                :colors="getProductColors"
                @on-select-color="onSelectColor"
                :active-color="activeColor"
                class="mb-3"
              ></color-select>

              <size-select
                :sizes="getProductSizes"
                @on-select-size="onSelectSize"
                :active-size="activeSize"
                class="mb-3"
              ></size-select>

              <a
                class="btn btn-link text-primary text-decoration-line pl-0"
                :href="productFinal.url"
              >Más información</a>
            </div>

            <div class="d-flex align-items-end align-items-xl-center">
              <div class="mt-1">
                <add-to-cart-button
                  @add-to-cart="addProductToCart"
                  :product="productFinal"
                  :variant="activeVariant"
                ></add-to-cart-button>
              </div>

              <div @click.prevent="toggleFavorite" class="cursor-pointer ml-3">
                <div class="text-primary">
                  <i class="far fa-heart" :class="[ productFinal.is_favorited ? 'fas' : '']"></i>
                </div>
              </div>
            </div>

            <div class="row mt-5">
              <div class="col-xs-6 col-md-6">
                <p class="text-dark-blue text-bold mb-1 text-sm">Beneficios</p>
                <div class="d-flex flex-wrap">
                  <a title="Entrega a domicilio">
                    <img
                      :src="baseUrl + '/images/icons/motorcicle-icon-small.svg'"
                      :alt="product.name"
                      class="mx-1 icon-xs"
                    />
                  </a>
                  <a title="Compras con tarjetas de crédito y débito">
                    <img
                      :src="baseUrl + '/images/icons/credit-card-icon-small.svg'"
                      :alt="product.name"
                      class="mx-1 icon-xs"
                    />
                  </a>
                  <a title="Primera lavada de ropa gratis">
                    <img
                      :src="baseUrl + '/images/icons/washing-machine-icon-small.svg'"
                      :alt="product.name"
                      class="mx-1 icon-xs"
                    />
                  </a>
                </div>
              </div>

              <div class="col-xs-6 col-md-6 mt-4 mt-md-0">
                <p class="text-dark-blue text-bold mb-0 text-sm">Compartir</p>

                <div class="d-flex flex-wrap">
                  <a
                    :href="'https://www.facebook.com/sharer/sharer.php?u=' + product.url"
                    @click="$ga.event('Producto', 'Compartir', 'Facebook', product.id);"
                    target="_blank"
                  >
                    <img
                      :src="baseUrl + '/images/icons/facebook-icon-small.svg'"
                      :alt="product.name"
                      class="mx-1 icon-xs"
                    />
                  </a>
                  <!-- <a href="#" onclick="$ga.event('Producs', 'share', 'Instagram');">
      <img src="baseUrl + '/images/icons/single-product/instagram-icon-small-grey.png'" alt="" class="mx-2">
                  </a>-->
                  <a
                    :href="'https://pinterest.com/pin/create/button/?url=' + product.url + '&media=' + product.main_image + '&description=' + product.name"
                    @click="$ga.event('Producto', 'Compartir', 'Pinterest', product.id);"
                    target="_blank"
                  >
                    <img
                      :src="baseUrl + '/images/icons/pinterest-icon-small.svg'"
                      :alt="product.name"
                      class="mx-1 icon-xs"
                    />
                  </a>
                  <!-- <a
                    :href="'https://wa.me/?text=' + product.url"
                    @click="$ga.event('Outfit', 'Compartir', 'WhatsApp', product.id);"
                    target="_blank"
                  >
                    <img
                      :src="baseUrl + '/images/icons/whatsapp-icon-small.svg'"
                      alt
                      class="mx-1 icon-xs"
                    />
                  </a> -->
                  
                  <a
                    :href="'https://api.whatsapp.com/send?text=' + product.url"
                    data-action="share/whatsapp/share"
                    @click="$ga.event('Outfit', 'Compartir', 'WhatsApp', product.id);"
                    target="_blank"
                  >
                    <img
                      :src="baseUrl + '/images/icons/whatsapp-icon-small.svg'"
                      alt
                      class="mx-1 icon-xs"
                    />
                  </a>
                </div>
              </div>
            </div>
          </article>
          <!-- card-body.// -->
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import Product from "../../models/Product";

export default {
  props: {
    product: null,
    isActiveSlide: false
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      loading: true,
      productFinal: Product,
      activeColor: null,
      activeSize: null
    };
  },

  computed: {
    getProductSizes() {
      let sizes = this.productFinal.sizes;
      if (!this.activeColor) {
        return null;
      }

      sizes = this.productFinal.variants
        .filter(v => v.color == this.activeColor)
        .filter(v => v.quantity > 0)
        .map(v => v.size)
        .filter((value, index, self) => self.indexOf(value) === index);

      if (sizes.length) this.activeSize = sizes[0];
      return sizes;
    },
    getProductColors() {
      let colors = this.productFinal.colors;

      colors = this.productFinal.variants
        .filter(v => v.quantity > 0)
        .map(v => v.color)
        .filter((value, index, self) => self.indexOf(value) === index);
      return colors;
    },
    activeVariant() {
      let variant = this.productFinal.variants.find(
        v => v.color == this.activeColor && v.size == this.activeSize
      );
      return variant;
    }
  },
  methods: {
    getBgImage(path) {
      let result = 'url("' + path + '")';
      // console.log(result);
      return result;
    },
    onSelectColor(color) {
      this.activeColor = color;
    },
    onSelectSize(size) {
      this.activeSize = size;
    },
    addProductToCart(data) {
      this.$emit("on-add-to-cart", data);
    },
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
    }
  },
  mounted() {
    if (this.product) {
      this.productFinal = new Product(this.product);

      this.activeColor = this.getProductColors.length
        ? this.getProductColors[0]
        : null;

      this.activeSize = this.getProductSizes.length
        ? this.getProductSizes[0]
        : null;

      this.loading = false;
    }
  }
};
</script>
