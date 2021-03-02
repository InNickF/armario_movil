<template>
  <div class="container">
    <div class="row" v-if="!loading">
      <div class="col-sm-12 col-md-12 col-lg-4">
        <product-images :product="product" :active-color="activeColor"></product-images>
      </div>
      <div class="px-4 col-sm-12 col-md-12 col-lg-8">
        <figcaption class="info-wrap mb-5">
          <!-- ! Inactive functionality -->
          <!-- <small class="font-weight-bold text-dark-blue">{{product.condition}}</!-->
          <small v-if="product.sells_count" class="text-dark-blue">{{product.sells_count}} vendidos</small>
          <span
            v-if="product.outfits && product.outfits.length"
            class="badge badge-secondary text-sm"
          >
            <small>En Outfit</small>
          </span>

          <h1 class="title text-primary text-left">{{ product.name }}</h1>
          <p class="desc text-primary">{{ product.description }}</p>
        </figcaption>

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="h-100">
              <p class="text-dark-blue font-weight-bold">Precio</p>
              <div class="bottom-wrap d-flex justify-content-start align-items-center">
                <div class>
                  <div v-if="product.has_discount">
                    <span
                      class="bg-pink py-2 px-4 rounded-lg font-weight-bold text-lg text-white"
                    >${{ product.final_price.toFixed(2) }}</span>
                    <del class="price-old text-muted">${{ product.price.toFixed(2) }}</del>
                  </div>

                  <span
                    v-else
                    class="bg-pink py-2 px-4 rounded-lg font-weight-bold text-lg text-white"
                  >${{ product.final_price.toFixed(2) }}</span>
                </div>
              </div>

              <div
                class="mt-5 mb-2 text-dark-blue mb-1 font-weight-bold"
              >Escoge tu color y talla preferida</div>
              <color-select
                :colors="getProductColors"
                @on-select-color="onSelectColor"
                :active-color="activeColor"
                class="mb-2"
              ></color-select>

              <size-select
                :sizes="getProductSizes"
                @on-select-size="onSelectSize"
                :active-size="activeSize"
                class="mb-2"
              ></size-select>

              <a
                target="_blank"
                :href="product.subsubcategory.link"
                class="text-sm ml-2 text-pink"
              >Abrir guía de tallas</a>

              <div class="font-weight-bold text-dark-blue mt-5 mb-3">Cantidades</div>

              <div class="d-flex align-items-end align-items-xl-center">
                <div class="mt-1">
                  <add-to-cart-button
                    @add-to-cart="addProductToCart"
                    :product="product"
                    :variant="activeVariant"
                  ></add-to-cart-button>
                </div>

                <div @click.prevent="toggleFavorite" class="cursor-pointer ml-3">
                  <div class="text-primary">
                    <i class="far fa-heart" :class="[ product.is_favorited ? 'fas' : '']"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="h-100">
              <div v-if="product.features && product.features.length">
                <p class="text-dark-blue font-weight-bold mb-1 mt-3 mt-md-0">Características</p>
                <ul class="text-dark-blue pl-3">
                  <li v-for="(feature, index) in product.features" :key="index">{{feature}}</li>
                </ul>
              </div>

              <div v-if="product.outfits.length">
                <p class="text-dark-blue font-weight-bold mb-1">Outfits con este producto</p>
                <ul class="text-dark-blue pl-3">
                  <li v-for="(outfit, index) in product.outfits" :key="index">
                    <a :href="outfit.url">{{outfit.name}}</a>
                  </li>
                </ul>
              </div>

              <div class="mt-2">
                <p class="text-dark-blue font-weight-bold mb-1">Código del producto</p>
                <p class="text-dark-blue">{{product.id}}</p>
              </div>

              <div class="row mt-4">
                <div class="col-xs-6 col-md-6">
                  <p class="text-dark-blue font-weight-bold mb-1">Beneficios</p>
                  <div class="d-flex flex-wrap">
                    <a title="Entrega a domicilio">
                      <img
                        :src="baseUrl + '/images/icons/motorcicle-icon-small.svg'"
                        title="Entrega a domicilio"
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a title="Compras con tarjetas de crédito y débito">
                      <img
                        :src="baseUrl + '/images/icons/credit-card-icon-small.svg'"
                        title="Pago con tarjeta de crédito"
                        class="mx-1 icon-xs"
                      />
                    </a>
                    <a title="Primera lavada de ropa gratis">
                      <img
                        :src="baseUrl + '/images/icons/washing-machine-icon-small.svg'"
                        title="Primer lavado gratis"
                        class="mx-1 icon-xs"
                      />
                    </a>
                  </div>
                </div>

                <div class="col-xs-6 col-md-6 mt-4 mt-md-0">
                  <p class="text-dark-blue font-weight-bold mb-0">Compartir</p>

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

                    <!-- <a
                      :href="'https://wa.me/?text=' + product.url"
                      @click="$ga.event('Producto', 'Compartir', 'WhatsApp', product.id);"
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
      <product-detail-footer v-if="userId" :product="product" :userId="userId"></product-detail-footer>
    </div>
  </div>
</template>



<script>
import Product from "../../models/Product";

export default {
  components: {},
  props: {
    productId: null,
    userId: null
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeSize: null,
      activeColor: null,
      product: Product,
      loading: true
    };
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
        .filter(v => v.quantity > 0)
        .map(v => v.size)
        .filter((value, index, self) => self.indexOf(value) === index);

      if (sizes.length) this.activeSize = sizes[0];
      return sizes;
    },

    getProductColors() {
      let colors = this.product.colors;

      colors = this.product.variants
        .filter(v => v.quantity > 0)
        .map(v => v.color)
        .filter((value, index, self) => self.indexOf(value) === index);
      return colors;
    },
    activeVariant() {
      return this.product.variants.find(
        v => v.color == this.activeColor && v.size == this.activeSize
      );
    }
  },
  methods: {
    async getProduct() {
      this.loading = true;
      var product = await Product.where("not_offline", true)
        .include("category", "store", "variants", "outfits")
        .find(this.productId);

      this.product = product;

      this.activeColor =
        this.getProductColors && this.getProductColors.length
          ? this.getProductColors[0]
          : null;

      this.activeSize =
        this.getProductSizes && this.getProductSizes.length
          ? this.getProductSizes[0]
          : null;

      this.loading = false;
    },
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
      // comes from addToCartButton with {product:product, qty:quantity, variant: variant}
      this.$emit("on-add-to-cart", data);
    },
    async toggleFavorite() {
      try {
        var response = await axios.get(
          this.apiUrl + "/products/" + this.product.id + "/favorite"
        );
        response = response.data.data;

        this.product.is_favorited = !this.product.is_favorited;

        this.$root.displayToast({
          image_url: this.product.main_image_thumbnail,
          title: this.product.name,
          body: this.product.is_favorited
            ? "Se ha agregado correctamente un artículo a tu wishlist"
            : "Se ha eliminado correctamente un artículo de tu wishlist",
          link: this.baseUrl + "/account/wishlist"
        });

        if (this.product.is_favorited) {
          this.$ga.event(
            "Producto",
            "Preguntas / Wishlist",
            this.product.name,
            this.product.id
          );
        }
      } catch (error) {
        this.$root.displayError(
          "Ha ocurrido un error al actualizar el artículo a tu Wishlist"
        );
      }
    }
  },
  mounted() {
    // console.log("SingleProduct mounted.", this.productId);
    this.getProduct();
    // if (this.product) {
    //   this.product = JSON.parse(this.product)
    // }
    // if (this.oldReview) {
    //   this.review = this.oldReview;
    // }
  }
};
</script>
