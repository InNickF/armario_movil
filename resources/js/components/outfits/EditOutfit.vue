<template>
  <div id="product-wizard-options">
    <!-- STEP 1 -->
    <div title="Datos del outfit">
      <div class="text-center">
        <h1 class="text-primary mb-3">Datos del outfit</h1>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name" class="w-100">
                Nombre del outfit
                <div>
                  <input name="name" v-model="outfit.name" class="form-control" />
                </div>
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="description" class="w-100 rounded">
                Descripción
                <div>
                  <textarea
                    name="description"
                    class="form-control"
                    rows="3"
                    v-model="outfit.description"
                  ></textarea>
                </div>
              </label>
            </div>
          </div>

          <div class="col-md-4">
            <div class>
              <label for="features" class="w-100">
                Características
                <v-select
                  class="v-select-border-primary"
                  taggable
                  multiple
                  noDrop
                  v-model="outfit.features"
                  name="features"
                ></v-select>

                <input name="features" type="hidden" class v-model="outfit.features" required />
              </label>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="text-center">
              <h1 class="text-primary">Fotografías y videos</h1>
            </div>
          </div>
          <div class="col-12 text-center" v-if="this.showVariantMediaUploader && outfit.media">
            <p class="text-primary">
              <strong>{{imagesError}}</strong>
            </p>
            <outfit-media
              :media="outfit.media"
              @on-add-media="onAddMedia"
              :allowed-images="getAllowedImages"
            ></outfit-media>
          </div>
        </div>

        <!-- PRODUCTS -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="text-center">
              <h1 class="text-primary">Productos</h1>
            </div>
            <p class="text-primary text-center">
              <strong>{{productsError}}</strong>
            </p>
          </div>
          <div class="col-md-3" v-if="outfit.products">
            <div class="my-2" v-for="(n, index) in [1,2,3,4]" :key="index">
              <div class="card outfit-products-uploader">
                <div class="card-body">
                  <!-- Loop 4 times -->
                  <label for="features" class="w-100">
                    <v-select
                      v-model="outfit.products[n]"
                      :placeholder="'Producto ' +n"
                      :options="getProductList"
                    ></v-select>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center">
              <img
                v-if="outfit.media && outfit.media.image_1"
                class="img-fluid"
                :src="getCenterImage"
                alt
              />
            </div>
          </div>
          <div class="col-md-3" v-if="outfit.products">
            <div class="my-2" v-for="(n, index2) in [5,6,7,8]" :key="index2">
              <div class="card outfit-products-uploader">
                <div class="card-body">
                  <!-- Loop 4 times -->
                  <label for="features" class="w-100">
                    <v-select
                      v-model="outfit.products[n]"
                      :placeholder="'Producto ' +n"
                      :options="getProductList"
                    ></v-select>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-primary my-4">Precio del outfit</h1>
            </div>
          </div>
          <div class="col-md-4 offset-md-4">
            <div class="form-group">
              <div class="card border-1 card-tuganancia">
                <div class="card-header bg-white border-0 text-primary font-weight-bold">Tu ganancia</div>

                <div class="card-body p-0">
                  <div class="d-flex justify-content-between">
                    <h4 class="text-primary font-weight-bold px-3">
                      <strong>${{earning}}</strong>
                    </h4>
                    <div class="pr-3">
                      <!-- <i class="fas fa-eye"></i> -->
                    </div>
                  </div>

                  <div class="bg-grey-3 px-3 py-2 text-primary">
                    <div class="d-flex justify-content-between">
                      <div>Outfit</div>
                      <div>$ {{finalPrice}}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div>Iva {{iva}}%</div>
                      <div>- $ {{taxPrice}}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div>Comisión ({{getCommission}} %)</div>
                      <div>- ${{commissionPrice}}</div>
                    </div>
                  </div>
                </div>

                <div class="card-footer bg-primary text-white">
                  <div class="d-flex flex-wrap justify-content-between">
                    <div>Para ti</div>
                    <div>${{earning}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center my-4">
      <div>
        <button
          @click.prevent="save()"
          :disabled="!valid"
          class="btn btn-primary btn-sm btn-wizard-siguiente"
        >
          <b>Guardar cambios</b>
        </button>
      </div>
    </div>

    <div class="d-flex flex-wrap justify-content-between my-4">
      <p class="text-danger text-center" v-if="!validateAll">Completa todos los datos para continuar</p>
    </div>
  </div>
</template>


<script>
import Outfit from "../../models/Outfit";
import Product from "../../models/Product";

export default {
  props: {
    iva: 12,
    user: null,
    outfitProp: null
  },
  watch: {
    outfit: {
      handler: function(val, oldVal) {
        this.validateAll();
      },
      deep: true
    }
  },
  data() {
    return {
      step: 1,
      outfit: {
        default: null,
        type: Outfit
      },
      products: [],
      baseUrl: process.env.MIX_APP_URL,
      showVariantMediaUploader: true,
      imagesError: "",
      productsError: "",
      valid: false
    };
  },
  methods: {
    async getProducts() {
      var query = Product;

      if (this.user) {
        query = query.where("store_id", this.user.store.id);
      }

      query = query
        .page(1)
        .where("has_stock", true)
        .include("store", "plans", "variants")
        .orderBy("-created_at");

      let response = await query.get();
      this.products = response.data;
    },
    async save() {
      try {
        // * IMPORTANT: format request
        this.outfit.products_ids = Object.keys(this.outfit.products)
          .map(index => {
            return {
              order: index,
              productId: this.outfit.products[index]
                ? this.outfit.products[index].value
                : null
            };
          })
          .filter(p => p.productId != null);
        let saved = await this.outfit.save();
        this.makeProductsToDropdownList();
        this.$root.displaySuccess("Outfit actualizado exitosamente");
      } catch (error) {
        this.$root.displayError(error.response ? error.response : error);
      }
    },
    onAddMedia(fieldName, path) {
      this.showColorMediaUploader = false;
      Vue.set(this.outfit.media, fieldName, path);
      this.showVariantMediaUploader = true;
    },
    navigateToOutfit() {
      window.location = this.outfit.url;
    },
    navigateToEditOutfit() {
      window.location = this.baseUrl + "/outfits/" + this.outfit.id + "/edit";
    },
    makeProductsToDropdownList() {
      let productsFinal = {};
      this.outfit.products.forEach((p, i) => {
        productsFinal[p.pivot.order] = {
          label: p.name,
          value: p.id
        };
      });

      this.outfit.products = productsFinal;
    },
    validateAll() {
      // if (!this.outfit) {
      //   return false;
      // }
      let valid = true;
      // Check if has images
      this.imagesError = "";
      if (!this.outfit.media || !this.outfit.media.image_1) {
        this.imagesError = "La primera imagen es obligatoria";
        console.error(
          "Invalid product has not first image: " +
            JSON.stringify(this.outfit.media)
        );
        valid = false;
      }

      // Check if has images
      this.productsError = "";
      if (
        !this.outfit.products ||
        !this.outfit.products[1] ||
        !this.outfit.products[1].value ||
        this.outfit.products[1].value == null
      ) {
        this.productsError = "El primer producto es obligatorio";
        console.error("Invalid outfit has not first product");
        valid = false;
      }

      if (
        !this.outfit.name ||
        !this.outfit.description ||
        !this.outfit.features
      ) {
        valid = false;
      }

      let JQueryValid = $("#outfit-wizard-form").valid();

      // Input fields validations
      this.valid = valid && JQueryValid;
    }
  },
  mounted() {
    if (this.outfitProp) {
      this.outfit = new Outfit(this.outfitProp);

      // * Transform products in dropdown list {label, value}
      this.makeProductsToDropdownList();
    }

    this.getProducts();
  },
  computed: {
    finalPrice: function() {
      let selectedProducts = this.products.filter(p =>
        Object.values(this.outfit.products).find(
          op => op != null && op.value == p.id
        )
      );
      let price = selectedProducts.length
        ? selectedProducts.map(p => p.final_price).reduce((a, b) => a + b)
        : 0;
      return parseFloat(price).toFixed(2);
    },
    finalPriceWithoutVat: function() {
      var minusTax = this.finalPrice / 1.12;
      return parseFloat(minusTax).toFixed(2);
    },
    taxPrice: function() {
      var taxValue = this.finalPrice - this.finalPriceWithoutVat;
      return parseFloat(taxValue).toFixed(2);
    },
    commissionPrice: function() {
      let subtotal = this.finalPriceWithoutVat;
      let divisor = 1 + this.getCommission / 100;

      let result = subtotal - subtotal / divisor;
      return parseFloat(result).toFixed(2);
    },
    earning: function() {
      var earning = this.finalPriceWithoutVat - this.commissionPrice;
      return parseFloat(earning).toFixed(2);
    },
    canGoBack() {
      return this.step > 1 && this.step < 3;
    },
    getAllowedImages() {
      return [1, 2, 3];
    },
    getCommission() {
      var commissionFeature = this.user.plan.features.find(feature => {
        return feature.name == "commission_percentage";
      });

      return commissionFeature.value;
    },
    getOutfitSizes() {
      let sizes = this.outfit.variants.map(variant => variant.size);
      let unique = sizes.filter((x, i, a) => a.indexOf(x) == i);
      return unique;
    },
    getProductList() {
      let list = this.products
        .filter(
          p =>
            !Object.values(this.outfit.products).find(
              op => op != null && op.value == p.id
            )
        )
        .map(product => {
          return {
            label: product.name,
            value: product.id
          };
        });
      list.unshift({
        label: "Selecciona...",
        value: null
      });

      return list;
    },
    getCenterImage() {
      if (this.outfit.media.image_1.includes("http")) {
        return this.outfit.media.image_1;
      }
      return this.baseUrl + "/storage/" + this.outfit.media.image_1;
    }
  }
};
</script>
