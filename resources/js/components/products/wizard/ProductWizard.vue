<template>
  <div id="product-wizard-options">
    <div v-if="step == 1" title="Categoría del producto">
      <div class="text-center">
        <div class="container px-md-5 px-2 w-sm-100 wizard-steps">
          <img
            v-if="step==1"
            :src="baseUrl + '/images/icons/wizard/wizard-step-1.svg'"
            class="mb-5"
            alt
          />
        </div>
        <h1 class="text-primary">¡Iniciemos!</h1>
        <p class="text-primary">Escoge una categoría de tu producto a vender</p>
      </div>

      <div class="d-flex justify-content-center mx-2 my-3 flex-wrap" v-if="parentCategories.length">
        <div
          v-for="(category, index) in parentCategories"
          :key="index"
          class="d-flex flex-column justify-content-center align-items-center mx-2 mb-4"
        >
          <div class="mb-2">
            <img
              :src="category.icon_image"
              class="img-sidebar img-svg-categoria image-svg icon-light"
              alt
            />
          </div>
          <div
            @click.prevent="selectCategory(category)"
            class="btn btn-primary btn-categoria-wizard btn-sm"
            :class="{'active': product.category_id == category.id}"
          >{{category.name}}</div>
        </div>

        <input type="hidden" v-model="product.category_id" name="category_id" />
      </div>

      <div class="text-center mt-5">
        <h1 class="text-primary">Información del producto</h1>
        <p
          class="text-primary"
        >Selecciona la información que corresponde al producto que vas a publicar.</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md mb-3" v-if="getSubCategoriesOptions.length">
            <v-select
              v-model="product.subcategory_id"
              :reduce="category => category.value"
              :options="getSubCategoriesOptions"
              placeholder="Subcategoría"
              @input="selectSubCategory"
            ></v-select>
          </div>

          <div class="col-md mb-3" v-if="getSubSubCategoriesOptions.length">
            <v-select
              v-model="product.subsubcategory_id"
              :reduce="category => category.value"
              :options="getSubSubCategoriesOptions"
              placeholder="Tipo de producto"
              @input="selectSubSubCategory"
            ></v-select>
          </div>

          <div class="col-md mb-3" v-if="styles.length">
            <v-select v-model="product.style" :options="styles" placeholder="Estilo del producto"></v-select>
          </div>

          <!-- ! Inactive functionality -->
          <!-- <div class="col-md" v-if="conditions.length">
            <v-select
              v-model="product.condition"
              :options="conditions"
              placeholder="Estado del producto"
            ></v-select>
          </div>-->
        </div>
      </div>
    </div>

    <!-- STEP 2 -->
    <div v-if="step == 2" title="Datos del producto">
      <div class="text-center">
        <div class="container px-md-5 px-2 w-sm-100 wizard-steps">
          <img
            v-if="step==2"
            :src="baseUrl + '/images/icons/wizard/wizard-step-2.svg'"
            class="mb-5"
            alt
          />
        </div>
        <h1 class="text-primary mb-3">Datos del producto</h1>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name" class="w-100">
                Nombre del producto
                <div>
                  <input name="name" v-model="product.name" class="form-control" />
                </div>
              </label>

              <label for="description" class="w-100 rounded">
                Descripción
                <div>
                  <textarea
                    name="description"
                    class="form-control"
                    rows="6"
                    v-model="product.description"
                  ></textarea>
                </div>
              </label>
            </div>
          </div>

          <!-- VARIANTS -->
          <div class="col-md-4">
            <div>
              <label class="mb-0">Colores disponibles</label>
              <wizard-variant-tabs
                :subsubcategory-id="product.subsubcategory_id.value"
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
            <label class="mb-0">Garantía</label>
            <p class="mb-4">
              <toggle-button
                color="#181b48"
                :labels="{checked: 'Sí', unchecked: 'No'}"
                v-model="product.has_guarantee"
              />
            </p>
            <p></p>
            <div v-show="product.has_guarantee" class="pt-2">
              <label for="guarantee_time_months">
                Tiempo de garantía (Meses)
                <input
                  type="number"
                  name="guarantee_time_months"
                  class="form-control"
                  maxlength="2"
                  max="24"
                  v-model="product.guarantee_time_months"
                />
              </label>
            </div>

            <div class>
              <label for="features" class="w-100">
                Características
                <v-select
                  class="v-select-border-primary v-select-taggable"
                  taggable
                  multiple
                  noDrop
                  v-model="product.features"
                  name="features"
                ></v-select>
              </label>
            </div>
          </div>
        </div>

        <div class="row my-4">
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
                          </div>        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <p class="text-primary font-weight-bold mb-0">Talla del modelo de ejemplo</p>
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

        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-primary my-4">Precio del producto</h1>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <div>
                <label for="price">
                  Precio de venta inicial
                  <input
                    placeholder="¿A qué precio lo vas a vender?"
                    type="number"
                    step="0.01"
                    name="price"
                    class="form-control"
                    v-model="product.price"
                  />
                </label>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="price" class>
                Activar descuento
                <p>
                  <toggle-button
                    color="#181b48"
                    :labels="{checked: 'Sí', unchecked: 'No'}"
                    v-model="product.has_discount"
                  />
                </p>
              </label>

              <div v-if="product.has_discount">
                <div>
                  <label for="discounted_price" class="pt-2">
                    Precio de descuento
                    <input
                      placeholder="¿A qué precio lo vas a vender con descuento?"
                      type="number"
                      step="0.01"
                      name="discounted_price"
                      class="form-control"
                      v-model="product.discounted_price"
                    />
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="bg-white text-primary font-weight-bold mb-3">Tu ganancia</div>
            <div class="form-group">
              <div class="card border-1">
                <div class="card-body p-0 mt-2">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="text-primary font-weight-bold mb-0 px-3">
                      <strong>${{earning}}</strong>
                    </h4>
                    <div class="pr-3">
                      <!-- <i class="fas fa-eye"></i> -->
                    </div>
                  </div>

                  <div class="bg-grey-3 px-3 py-2 text-primary">
                    <div class="d-flex justify-content-between">
                      <div>Producto</div>
                      <div>$ {{finalPrice}}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div>IVA {{iva}}%</div>
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

    <!-- STEP 3 -->
    <div v-if="step == 3" title="Anunciar producto">
      <div class="text-center">
        <div class="container px-md-5 px-2 w-sm-100 wizard-steps">
          <img
            v-if="step==3"
            :src="baseUrl + '/images/icons/wizard/wizard-step-3.svg'"
            class="mb-5"
            alt
          />
          <product-plan-select :product="product" @on-select-plan="onSelectPlan"></product-plan-select>
        </div>
      </div>
    </div>

    <!-- STEP 4 -->
    <div v-if="step == 4" title="Finalizado">
      <div class="text-center">
        <div class="container px-md-5 px-2 w-sm-100 wizard-steps">
          <img
            v-if="step==4"
            :src="baseUrl + '/images/icons/wizard/wizard-step-4.svg'"
            class="mb-5"
            alt
          />
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1 class="text-primary">¡Felicidades!</h1>

              <div class="row">
                <div class="col-md-6 col-sm-10 mx-auto">
                  <img class="img-fluid rounded" :src="product.main_image" alt />
                </div>
              </div>
              <h1 class="text-primary mt-3">{{product.name}}</h1>
              <div class="text-sm text-primary">
                <small>
                  Ha sido subido exitosamente, máximo en dos horas se validará la
                  informaciónde tu producto para ser publicada.
                </small>
              </div>
              <p class="text-sm">
                <small>Código de producto: {{ product.id }}</small>
              </p>

              <div>
                <button
                  @click.prevent="navigateToProducts()"
                  class="btn btn-lg btn-outline-primary mx-3 px-5 pt-2 pb-1"
                >Ir a Mis productos</button>
                <button
                  @click.prevent="navigateToCreate()"
                  class="btn btn-lg btn-light-green mx-3 pt-2 pb-1 px-4"
                >Subir otro producto</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center my-4" v-if="showNavigation">
      <div>
        <button
          @click.prevent="prevStep()"
          v-if="canGoBack"
          class="btn btn-primary btn-sm btn-wizard-anterior mx-3"
        >Anterior</button>
      </div>
      <div>
        <button
          @click.prevent="nextStep()"
          :disabled="!valid"
          class="btn btn-primary btn-sm btn-wizard-siguiente"
        >
          <b>Siguiente</b>
        </button>
      </div>
    </div>

    <div class="d-flex flex-wrap justify-content-center my-4 pl-4 text-sm" v-if="showNavigation">
      <p class="text-danger text-center" v-if="!valid">{{errorMessage}}</p>
    </div>
  </div>
</template>


<script>
import Product from "../../../models/Product";

export default {
  props: {
    iva: 12,
    user: null
  },
  watch: {
    product: {
      handler: function(val, oldVal) {
        this.validate();
      },
      deep: true
    }
  },
  data() {
    return {
      errorMessage: "Completa todos los campos para continuar",
      step: 1,
      product: new Product({
        variants: [
        //   {
        //     id: 1,
        //     color: "#cccccc",
        //     size: "",
        //     quantity: 1
        //   }
        ],
        example_size: "",
        price: null,
        has_discount: false,
        discounted_price: null,
        category_id: 1,
        subcategory_id: null,
        subsubcategory_id: null,
        condition: "Nuevo",
        has_guarantee: false,
        guarantee_time_months: 3,
        colors_media: {
          // '#cccccc': {}
        }
      }),
      baseUrl: process.env.MIX_APP_URL,
      showVariantMediaUploader: true,
      // selectedColors: [],
      parentCategories: [],
      subCategories: [],
      subSubCategories: [],
      conditions: ["Nuevo", "Usado"],
      styles: [
        { label: "Elegante", value: "elegant" },
        { label: "Casual", value: "casual" },
        { label: "Minimalista (Básicos)", value: "minimal" },
        { label: "Sporty (Deportivo)", value: "sporty" },
        { label: "Romántico (Retro)", value: "romantic" },
        { label: "Rocker (Rebelde)", value: "rocker" },
        { label: "Hipster (Fusión)", value: "hipster" },
        { label: "Urban", value: "urban" }
      ],
      valid: false
      // hasGuarantee: false,
      // product.has_discount: false,
      // quantity: 1,
      // features: []
    };
  },
  methods: {
    async createProduct() {
      let tempProduct = JSON.parse(JSON.stringify(this.product));
      try {
        // backup

        this.product.subcategory_id = this.product.subcategory_id.value; // Fix value because v-select returns object
        this.product.subsubcategory_id = this.product.subsubcategory_id.value; // Fix value because v-select returns object
        this.product.style = this.product.style.value; // Fix value because v-select returns object

        let saved = await this.product.save();
        this.$root.displaySuccess(
          "Producto creado exitosamente, en la siguiente pantalla puedes promocionar tu producto"
        );
        return true;
      } catch (error) {
        this.$root.displayError(
          error.response != undefined ? error.response : error
        );
        // revert
        this.product = tempProduct;
        return false;
      }
    },
    async nextStep() {
      this.errorMessage = "";

      if (this.step == 1) {
        this.step++;
        this.scrollToTop();
        this.validate();
        return;
      }

      // If is product create step
      if (this.step == 2) {
        var created = await this.createProduct();
        // console.log("created:", created);
        if (created) {
          this.step++;
          this.scrollToTop();
        }
      } else if (this.step < 4) {
        this.step++;
        this.scrollToTop();
      }
    },
    prevStep() {
      this.errorMessage = "";
      if (this.canGoBack) {
        this.step--;
        this.scrollToTop();
      }

      this.validate();
    },
    scrollToTop() {
      window.scrollTo(0, 0);
    },
    selectCategory(category) {
      this.product.category_id = category.id;
      this.subCategories = this.categories.filter(category => {
        return category.parent_id == this.product.category_id;
      });
      this.product.subcategory_id = null;
      this.product.subsubcategory_id = null;

      this.selectSubCategory();
      // console.log(this.subCategories);
    },
    selectSubCategory() {
      this.product.subsubcategory_id = null;
      this.subSubCategories = [];
      if (this.product.subcategory_id && this.product.subcategory_id.value) {
        // this.product.subcategory_id = category;
        this.subSubCategories = this.categories.filter(cat => {
          return cat.parent_id == this.product.subcategory_id.value;
        });
      }

      if (!this.subSubCategories.length) {
        this.subSubCategories = [
          {
            name: "General",
            id: null
          }
        ];
      }
    },
    selectSubSubCategory(category) {
      // this.subSubCategories = this.categories.filter(category => {
      //   return category.parent_id == this.product.subcategory_id;
      // });
      // this.product.subsubcategory_id = category;
      // console.log(this.subCategories);
    },
    getCategories() {
      axios.get(process.env.MIX_API_URL + "/categories").then(
        response => {
          this.categories = response.data.data;
          this.parentCategories = this.categories.filter(category => {
            return category.parent_id == null;
          });
          this.selectCategory(this.categories[0]);
        },
        error => {
          console.error(error);
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
    onAddVariant(hex) {
      let newId = this.product.variants.length
        ? this.product.variants[this.product.variants.length - 1].id + 1
        : 1;
      this.product.variants.push({
        id: newId,
        color: hex,
        size: null,
        quantity: 1
      }); // Increase ID

      if (!this.product.colors_media[hex]) {
        Vue.set(this.product.colors_media, hex, {});
      }
    },
    onRemoveVariant(variantId) {
      // console.log(variant);
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
    },
    onAddColorMedia(color, fieldName, path) {
      // Add path to media object
      Vue.set(this.product.colors_media[color], fieldName, path);
      // this.$forceUpdate(); // THIS ONE DOES WORK!

      this.showVariantMediaUploader = true;
    },
    onRemoveColorMedia(color, fieldName) {
      // Add path to media object
      Vue.delete(this.product.colors_media[color], fieldName);
    },
    selectSize(variantId, size) {
      let variant = this.product.variants.find(c => c.id == variantId);
      variant.size = size;

      // If example size is not in options, reset to first available
      if (
        !this.getProductSizes.find(size => size == this.product.example_size)
      ) {
        this.selectExampleSize(this.getProductSizes[0]);
      }
    },
    selectExampleSize(size) {
      this.product.example_size = size;
    },
    onSelectPlan(plan) {
      if (plan.price <= 0) {
        this.nextStep();
      }
    },
    navigateToCreate() {
      window.location = this.baseUrl + "/account/products/create";
    },
    navigateToProducts() {
      window.location = this.baseUrl + "/account/products/";
    },
    validate() {
      switch (this.step) {
        case 1:
          this.valid =
            this.product.category_id != null &&
            this.product.subcategory_id != null &&
            this.product.style != null;
          break;

        case 2:
          if (
            !this.product.category_id ||
            !this.product.subcategory_id ||
            !this.product.style
          ) {
            this.valid = false;
            this.errorMessage = "Ingresa las categorías del producto";
            break;
          }

          if (!this.product.name || !this.product.name.length) {
            this.valid = false;
            this.errorMessage = "Ingresa el nombre del producto";
            break;
          }

          if (!this.product.description || !this.product.description.length) {
            this.valid = false;
            this.errorMessage = "Ingresa la descripción del producto";
            break;
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
              break;
            }
          }

          // Check if has variants and colors has images
          if (!this.product.variants.length) {
            this.valid = false;
            this.errorMessage =
              "Ingresa al menos una variante de color, talla y stock";
            break;
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
            break;
          }

          if (!this.product.price) {
            this.valid = false;
            this.errorMessage = "Ingresa el precio del producto";
            break;
          }

          // Check if has discount
          if (this.product.has_discount == true) {
            if (
              this.product.discounted_price == null ||
              !this.product.discounted_price.length ||
              parseFloat(this.product.discounted_price) >=
                parseFloat(this.product.price)
            ) {
              this.valid = false;
              this.errorMessage =
                "Ingresa un precio de descuento menor al precio de venta";
              break;
            }
          }

          if (!this.product.example_size) {
            this.valid = false;
            this.errorMessage =
              "Ingresa la talla del modelo de ejemplo del producto";
            break;
          }

          // Input fields validations
          // let JQueryValid = $("#product-wizard-form").valid();
          this.valid = true;
          break;

        case 3:
          this.valid = true;
          break;

        case 4:
          this.valid = true;
          break;

        default:
          this.valid = false;
          break;
      }

      // console.log("isValid final:", valid);

      // return typeof valid === "boolean" ? valid : false;
    }
  },
  mounted() {
    // console.log("User", this.user);
    this.getCategories();
  },
  computed: {
    getSubCategoriesOptions() {
      return this.subCategories.map(category => {
        return {
          label: category.name,
          value: category.id
        };
      });
    },
    getSubSubCategoriesOptions() {
      return this.subSubCategories.map(category => {
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
    canGoBack() {
      return this.step > 1 && this.step < 3;
    },
    showNavigation() {
      return this.step < 4;
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
      if(!this.product.variants.length) {
        return []
      }

      let sizes = this.product.variants
        .map(variant => variant.size)
        .filter(size => size != "");
      let unique = sizes.filter((x, i, a) => a.indexOf(x) == i);

      if (!this.product.example_size) {
        this.selectExampleSize(unique[0]);
      }
      return unique;
    }
  }
};
</script>
