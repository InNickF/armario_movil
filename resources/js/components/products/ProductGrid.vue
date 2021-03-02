<template>
  <div class="mb-4 pt-0">
    <div class="my-4">
      <div v-if="showFilters" class="form-group">
        <div class="row mt-0">
          <!-- If is store list, show the Stories button -->
          <div v-if="storeId && storeHasStories" class="col-md-4 my-2">
            <button
              @click="showStories"
              class="btn btn-primary-gradient btn-block font-italic font-weight-bold"
            >VER OFERTAS 24 HORAS</button>
          </div>

          <div v-if="!categoryId" class="col-md-4 my-2">
            <v-select
              v-model="category"
              :options="getCategories"
              @input="filter()"
              placeholder="Categoría..."
            ></v-select>
          </div>

          <div v-if="!subCategoryId" class="col-md-4 my-2">
            <v-select
              v-model="subCategory"
              :options="getSubcategories"
              @input="filter()"
              placeholder="Subcategoría..."
            ></v-select>
          </div>

          <div class="col-md-4 my-2" v-if="getSubSubcategories.length">
            <v-select
              v-model="subSubCategory"
              :options="getSubSubcategories"
              @input="filter(); getProductSizes(subSubCategory.value);"
              placeholder="Tipo..."
            ></v-select>
          </div>

          <div class="col-md-4 my-2" v-if="styles.length">
            <v-select
              v-model="selectedStyle"
              :options="styles"
              placeholder="Estilo..."
              @input="filter()"
            ></v-select>
          </div>

          <div class="col-md-4 my-2" v-if="sizes">
            <v-select
              v-model="selectedSize"
              :options="getSizes"
              placeholder="Tamaño..."
              @input="filter()"
            ></v-select>
          </div>

          <div class="col-md-4 my-2 select2-colors" v-if="colors.length">
            <v-select
              v-model="selectedColor"
              :options="colors"
              placeholder="Color..."
              @input="filter()"
            >
              <template slot="option" slot-scope="option">
                <div>
                  <div
                    v-if="option.value"
                    class="rounded text-center border"
                    :style="{backgroundColor: '#'+(option.value)}"
                    style="width: 100%; height: 20px;"
                  ></div>
                  <div v-else>{{option.label}}</div>
                </div>
              </template>

              <template slot="selected-option" slot-scope="option">
                <div
                  v-if="option.value"
                  class="rounded text-center border"
                  :style="{backgroundColor: '#'+(option.value)}"
                  style="width: 100%; height: 20px; pointer-events: none;"
                ></div>
                <div v-else>{{option.label}}</div>
              </template>
            </v-select>
          </div>

          <div class="col-md-4 my-2" v-if="prices.length">
            <v-select
              v-model="selectedPriceRange"
              :options="prices"
              placeholder="Precio..."
              @input="filter()"
            ></v-select>
          </div>

          <div class="col-md-4 my-2" v-if="plans.length && storeIdFinal == null">
            <v-select
              v-model="selectedPlan"
              :options="plans"
              placeholder="Tienda..."
              @input="filter()"
            ></v-select>
          </div>

          <div class="col-md-4 my-2" v-if="cities.length && storeIdFinal == null">
            <v-select
              v-model="selectedCity"
              :options="getCitiesOptions"
              placeholder="Ciudad de la tienda..."
              @input="filter()"
            ></v-select>
          </div>
        </div>
      </div>

      <slot></slot>

      <div class>
        <div v-if="!loading" class="row card-deck px-3 px-md-0">
          <div
            v-for="(product, index) in products"
            :key="index"
            class="col-lg-3 col-sm-6 card my-3"
          >
            <product-card :product="product"></product-card>
          </div>

          <div v-if="showMoreBtn && !isLastPage" class="w-100 my-5 text-primary text-center">
            <button
              @click="page++; getProducts()"
              class="btn btn-primary btn-sm"
            >Cargar más</button>
          </div>

            <div class="w-100 my-5 text-primary text-center" v-if="loading">Cargando...</div>

          <div v-if="!products.length" class="w-100 my-5 py-5 text-primary">
            <p class="text-center">No se han encontrado productos</p>
          </div>
        </div>
        <div v-else class="w-100 my-5 py-5 text-primary">  <p class="text-center">Cargando...</p> </div>
      </div>
    </div>
  </div>
</template>


<script>
import Product from "../../models/Product";

export default {
  props: {
    showFilters: true,
    storeId: null,
    categoryId: null,
    plan: null,
    planSecondary: null,
    onlyFollowedCategories: false,
    storeHasStories: false,
    limit: {
      type: Number,
      default: 12
    },
    subCategoryId: null,
    showMoreBtn: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      baseUrl: process.env.MIX_API_URL,
      page: 1,
      isLastPage: false,
      loading: false,
      storeIdFinal: null,
      products: [],
      categories: [],
      category: null,
      subCategory: null,
      subSubCategory: null,
      selectedStyle: null,
      selectedSize: null,
      selectedColor: null,
      selectedPriceRange: null,
      selectedCity: null,
      selectedPlan: null,
      search: "",
      title: "",
      sizes: [],
      prices: [
        {
          label: "Todos los precios",
          value: null
        },
        {
          label: "0 a $10",
          value: "0_10"
        },
        {
          label: "$10 a $20",
          value: "10_20"
        },
        {
          label: "$20 a $50",
          value: "20_50"
        },
        {
          label: "$50 a $100",
          value: "50_100"
        },
        {
          label: "$100 en adelante",
          value: "100_0"
        }
      ],
      colors: [
        {
          label: "Todos los colores",
          value: null
        },
        {
          label: "ffffff",
          value: "ffffff"
        },
        {
          label: "cccccc",
          value: "cccccc"
        },
        {
          label: "00cadf",
          value: "00cadf"
        },
        {
          label: "1d66f6",
          value: "1d66f6"
        },
        {
          label: "ff00ff",
          value: "ff00ff"
        },
        {
          label: "ff0000",
          value: "ff0000"
        },
        {
          label: "f57900",
          value: "f57900"
        },
        {
          label: "f8c300",
          value: "f8c300"
        },
        {
          label: "0ebcbe",
          value: "0ebcbe"
        },
        {
          label: "43cb00",
          value: "43cb00"
        },
        {
          label: "c89673",
          value: "c89673"
        },
        {
          label: "ffecc7",
          value: "ffecc7"
        },
        {
          label: "231f20",
          value: "231f20"
        },
        {
          label: "666666",
          value: "666666"
        },
        {
          label: "005181",
          value: "005181"
        },
        {
          label: "2e00bc",
          value: "2e00bc"
        },
        {
          label: "662d91",
          value: "662d91"
        },
        {
          label: "c1272d",
          value: "c1272d"
        },
        {
          label: "e24900",
          value: "e24900"
        },
        {
          label: "ff9800",
          value: "ff9800"
        },
        {
          label: "00a385",
          value: "00a385"
        },
        {
          label: "47743f",
          value: "47743f"
        },
        {
          label: "7d5544",
          value: "7d5544"
        },
        {
          label: "f5beb8",
          value: "f5beb8"
        }
      ],
      styles: [
        { label: "Todos los estilos", value: null },
        { label: "Elegante", value: "elegant" },
        { label: "Casual", value: "casual" },
        { label: "Minimalista (Básicos)", value: "minimal" },
        { label: "Sporty (Deportivo)", value: "sporty" },
        { label: "Romántico (Retro)", value: "romantic" },
        { label: "Rocker (Rebelde)", value: "rocker" },
        { label: "Hipster (Fusión)", value: "hipster" },
        { label: "Urban", value: "urban" }
      ],
      cities: [],
      plans: [
        { label: "Todos", value: null },
        { label: "Armario", value: "armario" },
        { label: "Clóset", value: "closet" },
        { label: "Ropero", value: "ropero" }
      ],
      stores: []
    };
  },
  methods: {
    async getProducts() {
      this.loading = true;
      var query = Product;

      if (this.storeIdFinal) {
        query = query.where("store_id", this.storeIdFinal);
      }

      if (this.categoryId) {
        query = query.where("category_id", this.categoryId);
      } else if (this.category && this.category.value != null) {
        query = query.where("category_id", this.category.value);
      }

      if (this.subCategoryId) {
        query = query.where("subcategory_id", this.subCategoryId);
      } else if (this.subCategory && this.subCategory.value != null) {
        query = query.where("subcategory_id", this.subCategory.value);
      }

      if (this.subSubCategory && this.subSubCategory.value != null) {
        query = query.where("subsubcategory_id", this.subSubCategory.value);
      }

      if (this.selectedStyle && this.selectedStyle.value != null) {
        query = query.where("style", this.selectedStyle.value);
      }

      // Custom scope
      if (this.selectedSize && this.selectedSize.value != null) {
        query = query.where("size", this.selectedSize.value);
      }
      // Custom scope
      if (this.selectedColor && this.selectedColor.value != null) {
        query = query.where("color", this.selectedColor.value);
      }

      if (this.selectedPriceRange && this.selectedPriceRange.value != null) {
        query = query.where("price", this.selectedPriceRange.value);
      }

      if (this.selectedCity && this.selectedCity.value != null) {
        query = query.where("city", this.selectedCity.value);
      }

      if (this.selectedPlan && this.selectedPlan.value != null) {
        // Override default plan
        query = query.where("store_plan", this.selectedPlan.value);
      }

      if (this.plan != null) {
        query = query.where("plan", this.plan);
      }

      if (this.onlyFollowedCategories) {
        query = query.where("followed_categories", "user");
      }

      query = query
        .page(this.page)
        .limit(this.limit)
        .where("has_stock", true)
        .include("store", "plans", "variants")
        .orderBy("-created_at");

      // this.products = []; // FIX state not updating
      let response = await query.get();

      let products = response.data;

      if (response.last_page <= this.page) {
        this.isLastPage = true;
      }

      if (this.page != 1) {
        this.products = [...this.products, ...products];
      } else {
        this.products = [];
        this.products = products;
      }

      this.loading = false;
    },
    getAllCategories() {
      axios.get(process.env.MIX_API_URL + "/categories").then(
        response => {
          this.categories = response.data.data;
        },
        error => {
          console.error(error);
        }
      );
    },
    async getProductSizes(subSubCategoryId = 0) {
      var url = this.baseUrl + "/product_sizes/" + subSubCategoryId;

      try {
        var response = await axios.get(url);
        this.sizes = response.data.data;
        this.selectedSize = null;
      } catch (error) {
        this.sizes = [];
      }
    },
    getCities() {
      axios.get(process.env.MIX_API_URL + "/ubigeos/cities").then(
        response => {
          this.cities = response.data;
        },
        error => {
          console.error(error);
        }
      );
    },
    getStores() {
      axios.get(process.env.MIX_API_URL + "/stores").then(
        response => {
          this.stores = response.data;
        },
        error => {
          console.error(error);
        }
      );
    },
    async filter() {
      // console.log("Apply a filter: ");
      this.page = 1
      this.getProducts();
    },
    async applySearch() {
      // console.log("Apply a search");
      this.products = await Product.where("search", this.search)
        .where("not_offline", true)
        .page(1)
        .limit(this.limit)
        // .include('categories')
        .orderBy("-created_at")
        .get();
      this.subCategory = "";
    },
    showStories() {
      // Find parent ref in root then locate component ref
      if (
        this.$root.$refs["StoriesModal"] &&
        this.$root.$refs["StoriesModal"].$refs["StoriesCarouselModal"]
      ) {
        this.$root.$refs["StoriesModal"].$refs["StoriesCarouselModal"].show(); // Show the modal
        this.$root.$refs["StoriesModal"].setActiveStoreId(this.storeId); // Set store ID to navigate to correct slide
      } else {
        console.error(refName + " ref was not found");
      }
    }
  },

  computed: {
    getCategoriesOptions() {
      return this.categories.map(category => {
        return {
          label: category.name,
          value: category.id
        };
      });
    },

    getCategories() {
      var result = [];

      result = this.categories.filter(category => {
        return category.parent_id == null;
      });

      result = result.map(category => {
        return {
          label: category.name,
          value: category.id
        };
      });

      result.unshift({
        label: "Todas las categorías",
        value: null
      });

      return result;
    },

    getSubcategories() {
      var result = [];

      let finalCatId;
      if (!this.categoryId) {
        if (this.category == null || this.category.value == null) {
          return result;
        }
        finalCatId = this.category.value;
      } else {
        finalCatId = this.categoryId;
      }

      if (!finalCatId) {
        return result;
      }

      result = this.categories.filter(category => {
        return category.parent_id == finalCatId;
      });

      result = result.map(category => {
        return {
          label: category.name,
          value: category.id
        };
      });

      result.unshift({
        label: "Todas las subcategorías",
        value: null
      });

      return result;
    },

    getSubSubcategories() {
      var result = [];

      if (this.subCategoryId) {
        result = this.categories.filter(category => {
          return category.parent_id == this.subCategoryId;
        });
      } else if (this.subCategory == null || this.subCategory.value == null) {
        return result;
      } else {
        result = this.categories.filter(category => {
          return category.parent_id == this.subCategory.value;
        });
      }

      if (!result.length) {
        return result;
      }

      result = result.map(sub => {
        return {
          label: sub.name,
          value: sub.id
        };
      });

      result.unshift({
        label: "Todos los tipos de producto",
        value: null
      });
      return result;
    },

    getStoresOptions() {
      var result = [];

      result = this.stores.map(i => {
        return {
          label: i.name,
          value: i.id
        };
      });

      result.unshift({
        label: "Todas las tiendas",
        value: null
      });
      return result;
    },
    getCitiesOptions() {
      var result = [];

      result = this.cities.map(i => {
        return {
          label: i,
          value: i
        };
      });

      result.unshift({
        label: "Todas las ciudades",
        value: null
      });
      return result;
    },
    getSizes() {
      let sizesFormatted = this.sizes;

      if (this.subSubCategory && this.subSubCategory.value) {
        sizesFormatted = sizesFormatted.filter(size => {
          if (!size.categories) {
            return false;
          }

          let belongsToSubsubcategory = size.categories.find(
            cat => cat.id == this.subSubCategory.value
          );

          if (belongsToSubsubcategory) {
            return true;
          }

          return false;
        });
      }

      sizesFormatted = sizesFormatted.map(i => {
        return {
          label: i.name,
          value: i.name
        };
      });

      sizesFormatted.unshift({
        label: "Todas las tallas",
        value: null
      });
      return sizesFormatted;
    }
  },

  mounted() {
    // console.log("Component mounted.");

    if (this.storeId) {
      this.storeIdFinal = this.storeId;
    }
    this.getProducts();
    this.getAllCategories();
    this.getCities();
    this.getProductSizes();
    // TODO: DO this only if not in store page
    this.getStores();
  }
};
</script>
