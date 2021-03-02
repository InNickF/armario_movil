<template>
  <div v-if="!loading">
    <div v-show="!showPlans">
      <div id="product-edit-header" class="d-flex flex-wrap align-items-center mb-5">
        <div class="img-wrap avatar-md rounded-circle mx-3">
          <img class="img-fluid" :src="product.main_image" />
        </div>

        <div class>
          <h3 class="m-2 text-primary">{{ product.name }}</h3>
          <div class="d-flex">
            <div class="d-flex flex-wrap align-items-center">
              <div class="d-flex flex-wrap">
                <div v-if="product.category" class="text-sm m-2 text-primary d-flex">
                  <div class="font-weight-bold mr-1">Categoría:</div>
                  <div>{{product.category.name}}</div>
                </div>
                <div v-if="product.categories != undefined" class="text-sm m-2 text-primary">
                  <strong>Subcategoría:</strong>
                  <span
                    v-for="(category, index) in product.categories"
                    :key="index"
                  >{{category.name}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="product-edit-options">
        <div>
          <div class="text-center">
            <h1 class="text-primary mb-4">Información básica del producto</h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name" class="font-weight-bold text-primary">Nombre del producto</label>
                  <div class="mb-5">
                    <input name="name" v-model="product.name" class="form-control" />
                  </div>

                  <label for="description" class="font-weight-bold text-primary">Descripción</label>

                  <div>
                    <textarea
                      name="description"
                      class="form-control"
                      rows="6"
                      v-model="product.description"
                    ></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-5">
                <div class="font-weight-bold text-primary">
                  Colores disponibles
                  <wizard-variant-tabs
                    :subsubcategory-id="product.subsubcategory_id"
                    :variants="product.variants"
                    @on-add-variant="onAddVariant"
                    @on-remove-variant="onRemoveVariant"
                    @on-select-variant-size="selectSize"
                    @on-add-variant-stock="increaseQuantity"
                    @on-remove-variant-stock="decreaseQuantity"
                  ></wizard-variant-tabs>
                </div>
              </div>

              <div class="col-md-4">
                <label class="font-weight-bold text-primary">Garantía</label>
                <p>
                  <toggle-button
                    color="#181b48"
                    :labels="{checked: 'Sí', unchecked: 'No'}"
                    v-model="product.has_guarantee"
                  />
                </p>

                <div v-show="product.has_guarantee">
                  <label for="guarantee_time_months" class="text-primary font-weight-bold">
                    Tiempo de garantía
                    (Meses)
                  </label>
                  <input
                    type="number"
                    name="guarantee_time_months"
                    class="form-control"
                    maxlength="2"
                    max="24"
                    v-model="product.guarantee_time_months"
                  />
                </div>

                <div class>
                  <label for="features" class="w-100 text-primary font-weight-bold">Características</label>
                  <v-select
                    taggable
                    multiple
                    noDrop
                    v-model="product.features"
                    class="v-select-border-primary"
                    name="features"
                  ></v-select>
                </div>
              </div>
            </div>

            <div id="product-wizard-options">
              <div class="row mt-4">
                <div class="col-12">
                  <div class="text-center">
                    <h1 class="text-primary">Fotografías y videos</h1>
                  </div>
                </div>
                <div
                  class="col-12 text-center"
                  v-if="this.showVariantMediaUploader && product.colors_media && product.variants.length"
                >
                  <product-color-variants-tabs
                    :media="product.colors_media"
                    @on-add-color-media="onAddColorMedia"
                    @on-remove-color-media="onRemoveColorMedia"
                    :allowed-images="getAllowedImages"
                  ></product-color-variants-tabs>
                </div>
                          <div class="text-danger col-12 text-center mb-4" v-else>
                            <small>Debes crear al menos una variante de color para poder subir fotos y videos</small>
                          </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="text-center">
                    <div class="text-primary">Talla del modelo de ejemplo</div>
                  </div>
                </div>

                <div class="col-md-12 text-center">
                  <div
                    v-if="getProductSizes && getProductSizes.length"
                    class="d-flex justify-content-center"
                  >
                    <wizard-example-size-select
                      :size="product.example_size"
                      :sizes="getProductSizes"
                      @select-example-size="selectExampleSize"
                    ></wizard-example-size-select>
                  </div>
                  <div v-if="!getProductSizes.length">
                    <small class="text-">Selecciona las tallas del producto para que aparezcan aquí</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-12">
                <div class="text-center">
                  <h1 class="text-primary mb-5">Precio del producto</h1>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div>
                    <label for="price" class="font-weight-bold text-primary">Precio de venta inicial</label>
                    <input
                      type="number"
                      step="0.01"
                      name="price"
                      class="form-control"
                      v-model="product.price"
                    />
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="price" class="font-weight-bold text-primary">Activar descuento</label>
                  <p>
                    <toggle-button
                      color="#181b48"
                      :labels="{checked: 'Sí', unchecked: 'No'}"
                      v-model="product.has_discount"
                    />
                  </p>

                  <div v-if="product.has_discount">
                    <div>
                      <label
                        for="discounted_price"
                        class="font-weight-bold text-primary"
                      >Precio de descuento</label>
                      <input
                        type="number"
                        step="0.01"
                        name="discounted_price"
                        class="form-control"
                        v-model="product.discounted_price"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="bg-white text-primary font-weight-bold mb-2">Tu ganancia</div>
                <div class="form-group">
                  <div class="card border-1 card-tuganancia">
                    <div class="card-body p-0 mt-2">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="text-primary font-weight-bold mb-0 px-3">${{earning}}</h4>
                        <div class="pr-3">
                          <!-- <i class="fas fa-eye"></i> -->
                        </div>
                      </div>

                      <div class="bg-grey px-3 py-2 text-primary">
                        <div class="d-flex justify-content-between">
                          <div class="text-primary">Producto</div>
                          <div class="text-primary">$ {{finalPrice}}</div>
                        </div>

                        <div class="d-flex justify-content-between">
                          <div class="text-primary">Iva {{iva}}%</div>
                          <div class="text-primary">- $ {{taxPrice}}</div>
                        </div>

                        <div class="d-flex justify-content-between">
                          <div class="text-primary">Comisión ({{getCommission}} %)</div>
                          <div class="text-primary">- ${{commissionPrice}}</div>
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
      </div>

      <div class="row mt-4">
        <div class="col-12 bg-gradient rounded-md-3 py-3 mb-5">
          <div class="text-center">
            <h1 class="text-white mb-0">Anuncio</h1>
            <div class="text-white-transparency text-sm mb-1">
              <small>
                Para cambiar el tipo de anuncio activo en tu producto debes
                dirigirte a la página de anuncios
              </small>
            </div>
            <!-- <div v-if="product.ad_type" class="text-sm text-white">Tipo de anuncio actual: {{product.ad_type.name}}</div> -->
            <button
              class="btn btn-white text-white btn-sm px-5 bg-transparent mt-1"
              @click.prevent="showPlans = true"
            >
              Ir a
              Anuncios
            </button>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div>
          <button @click.prevent="goBack" class="btn btn-outline-primary btn-sm mr-2">Cancelar</button>
        </div>
        <div>
          <button
            :disabled="!valid"
            @click.prevent="updateProduct()"
            class="btn btn-light-green btn-sm ml-auto"
          >
            <b>Guardar cambios</b>
          </button>
        </div>
      </div>

      <div class="d-flex flex-wrap justify-content-center my-4 pl-4 text-sm">
        <p class="text-danger text-center" v-if="!valid">{{errorMessage}}</p>
      </div>
    </div>

    <div v-if="showPlans">
      <div>
        <product-plan-select :product="product"></product-plan-select>
        <button
          @click.prevent="showPlans = false"
          class="btn btn-primary btn-sm font-weight-bold mt-5"
        >Atrás</button>
      </div>
    </div>
  </div>
</template>


<script>
import Product from "../../models/Product";

export default {
  props: {
    iva: null,
    commission: null,
    productId: Number,
    user: null
  },
  data() {
    return {
      product: Product,
      baseUrl: process.env.MIX_APP_URL,
      showVariantMediaUploader: true,
      errorMessage: "",
      parentCategories: [],
      childCategories: [],
      conditions: ["Nuevo", "Usado"],
      showPlans: false,
      loading: true,
      canSave: true,
      valid: false
    };
  },
  watch: {
    product: {
      handler: function(val, oldVal) {
        this.validate();
      },
      deep: true
    }
  },
  methods: {
    async getProduct() {
      this.loading = true;
      var product = await Product.include("category", "store").find(
        this.productId
      );

      this.product = product;

      this.product.variants.forEach(v => {
        if (!v.media) v.media = {};
      });


      Object.keys(this.product.colors_media).forEach((colorKey) => {
        let v = this.product.colors_media[colorKey]
        console.log(colorKey, v);
        if (Array.isArray(v)) Vue.set(this.product.colors_media, colorKey, {})
        console.log("TCL: getProduct -> this.product.colors_media[colorKey]", this.product.colors_media[colorKey])
      });

      this.loading = false;
    },
    async updateProduct() {
      try {
        Object.keys(this.product).forEach(key => {
          var keysToDelete = [
            "category",
            "subcategory",
            "subsubcategory",
            "store",
            "main_image",
            "main_image_thumbnail",
            "ad_type",
            "sells_count",
            "url",
            "is_favorited",
            "colors",
            "sizes"
          ];
          keysToDelete.forEach(keyToDelete => {
            if (key == keyToDelete) {
              delete this.product[key];
            }
          });
        });
        await this.product.save();

        this.$root.displaySuccess("Producto actualizado");

        return true;
      } catch (error) {
        let message = error.response.data.errors
          ? error.response.data.errors
          : error.message;
        this.$root.displayError(message);
        return false;
      }
    },
    getCategories() {
      axios.get(process.env.MIX_API_URL + "/categories").then(
        response => {
          this.categories = response.data.data;
          this.parentCategories = this.categories.filter(category => {
            return category.parent_id == null;
          });
          //   this.childCategories = categories.filter(category => {
          //     return category.parent_id != null;
          //   });
        },
        error => {
          this.$root.displayError(error);
        }
      );
    },
    getCategories() {
      axios.get(process.env.MIX_API_URL + "/categories").then(
        response => {
          this.categories = response.data.data;
          this.parentCategories = this.categories.filter(category => {
            return category.parent_id == null;
          });
          //   this.childCategories = categories.filter(category => {
          //     return category.parent_id != null;
          //   });
        },
        error => {
          this.$root.displayError(error);
        }
      );
    },
    increaseQuantity(variantId) {
      let variant = this.product.variants.find(c => c.id == variantId);
      if (variant.quantity < 1000) {
        variant.quantity++;
      }
    },
    decreaseQuantity(variantId) {
      let variant = this.product.variants.find(c => c.id == variantId);
      if (variant.quantity > 1) {
        variant.quantity--;
      }
    },
    onAddVariant(hex, newId) {
      this.showVariantMediaUploader = false;
      this.product.variants.push({
        id: newId,
        color: hex,
        size: null,
        quantity: 1
      }); // Increase ID

      if (!this.product.colors_media[hex]) {
        Vue.set(this.product.colors_media, hex, {});
      }

      this.showVariantMediaUploader = true;
    },
    onRemoveVariant(variantId) {
      this.showVariantMediaUploader = false;
      let variantColor = this.product.variants.find(v => v.id == variantId)
        .color;

      // if (this.product.variants.length <= 1) {
      //   this.$root.displayError("Tu producto debe tener por lo menos un color");
      //   return;
      // }
      this.product.variants = this.product.variants.filter(
        c => c.id != variantId
      );

      if (!this.product.variants.find(v => v.color == variantColor)) {
        Vue.delete(this.product.colors_media, variantColor);
      }

      this.showVariantMediaUploader = true;
    },
    onAddColorMedia(color, fieldName, path) {
      console.log("TCL: onAddColorMedia -> color, fieldName, path", color, fieldName, path)
      // Add path to media object
      Vue.set(this.product.colors_media[color], fieldName, path);
      console.log("TCL: onAddColorMedia -> this.product.colors_media", this.product.colors_media)
      this.showVariantMediaUploader = true;
    },
    onRemoveColorMedia(color, fieldName) {
      // Add path to media object
      Vue.delete(this.product.colors_media[color], fieldName);
    },
    selectSize(variantId, size) {
      let variant = this.product.variants.find(c => c.id == variantId);
      variant.size = size;
    },
    selectExampleSize(size) {
      this.product.example_size = size;
    },
    goBack() {
      window.location = this.baseUrl + "/account/products/";
    },
    validate() {
      if (
        !this.product.category_id ||
        !this.product.subcategory_id ||
        !this.product.style
      ) {
        this.valid = false;
        this.errorMessage = "Ingresa las categorías del producto";
        return;
      }

      if (!this.product.name || !this.product.name.length) {
        this.valid = false;
        this.errorMessage = "Ingresa el nombre del producto";
        return;
      }

      if (!this.product.description || !this.product.description.length) {
        this.valid = false;
        this.errorMessage = "Ingresa la descripción del producto";
        return;
      }

      // Check if has guarantee
      if (this.product.has_guarantee == true) {
        if (
          this.product.guarantee_time_months == null ||
          this.product.guarantee_time_months <= 0
        ) {
          this.valid = false;
          this.errorMessage =
            "Ingresa el tiempo de garantía en meses hasta un valor de 24";
          return;
        }
      }

      // Check if colors has images
      if (!this.product.variants.length) {
        this.valid = false;
        this.errorMessage =
          "Ingresa al menos una variante de color, talla y stock";
        return;
      }

      for (let index = 0; index < this.product.variants.length; index++) {
            const element = this.product.variants[index];
            if(!element.size) {
              this.valid = false;
              this.errorMessage =
                "Selecciona una talla para cada variante de color";
              break;
            }
          }


      let colorMediaKeys = Object.keys(this.product.colors_media);

      let emptyColors = colorMediaKeys.filter(colorIndex => {
        var media = this.product.colors_media[colorIndex];
        if (
          media == undefined ||
          media.image_1 == undefined ||
          media.image_1 == null ||
          !media.image_1.length
        ) {
          return true;
        }
      });

      if (emptyColors.length) {
        this.valid = false;
        this.errorMessage = "Ingresa la primera imagen de cada color";
        return;
      }

      if (!this.product.price) {
        this.valid = false;
        this.errorMessage = "Ingresa el precio del producto";
        return;
      }

      // Check if has discount
      if (this.product.has_discount == true) {
        if (
          this.product.discounted_price == null ||
          parseFloat(this.product.discounted_price) >=
            parseFloat(this.product.price)
        ) {
          this.valid = false;
          this.errorMessage =
            "Ingresa un precio de descuento menor al precio de venta";
          return;
        }
      }

      if (!this.product.example_size) {
        this.valid = false;
        this.errorMessage =
          "Ingresa la talla del modelo de ejemplo del producto";
        return;
      }

      // Input fields validations
      // let JQueryValid = $("#product-wizard-form").valid();
      this.valid = true;
    }
  },
  async mounted() {
    this.getCategories();
    this.getProduct();
  },
  computed: {
    getChilCategoriesOptions() {
      return this.childCategories.map(category => {
        return {
          label: category.name,
          value: category.id
        };
      });
    },
    finalPrice: function() {
      var price =
        this.product.has_discount == true && this.product.discounted_price
          ? this.product.discounted_price
          : this.product.price
          ? this.product.price
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
    getMinPrice: function() {
      var val = this.product.price - this.commissionPrice;
      return val <= 0 ? this.commissionPrice : val;
    },
    discountedIsLessThanPrice: function() {
      return (
        parseFloat(this.product.discounted_price) <=
        parseFloat(this.product.price)
      );
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
    getProductSizes() {
      let sizes = this.product.variants
        .map(variant => variant.size)
        .filter(size => size != "");
      let unique = sizes.filter((x, i, a) => a.indexOf(x) == i);
      return unique;
    }
  }
};
</script>
