<template>
  <div class="py-5 my-2 my-md-5">
    <swiper
      :options="swiperOption"
      ref="homeSingleProductCarousel"
      @slide-change="onSwiperEvent"
      data-step="singleProductSlider"
    >
      <!-- slides -->
      <swiper-slide v-for="(product, index) in products" :key="index">
        <div class="container">
          <div class="row">
            <div class="content-i col-sm-12 col-md-12 col-lg-11 mx-auto">
              <div class="content-box">
                <div class="element-wrapper">
                  <div class="element-box">
                    <single-product-small
                      :is-active-slide="isActiveSlide(index)"
                      :product="product"
                      @on-add-to-cart="$root.addProductToCart"
                    ></single-product-small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </swiper-slide>

      <!-- Optional controls -->
      <!-- <div class="swiper-pagination" slot="pagination"></div> -->
      <div class="swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button-next" slot="button-next"></div>
      <!-- <div class="swiper-scrollbar" slot="scrollbar"></div> -->
    </swiper>

    <div class="w-100 text-center">
      <p v-if="!products || !products.length">No se han encontrado productos recomendados</p>
    </div>
  </div>
</template>



<script>
import Product from "../../models/Product";

export default {
  props: {
    plan: {
      default: "fashion"
    },
    onlyFollowedCategories: false
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeColor: null,
      activeSize: null,
      loading: true,
      products: Product,
      swiperOption: {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        }
      }
    };
  },

  computed: {
    swiper() {
      return this.$refs.homeSingleProductCarousel.swiper;
    }
  },
  methods: {
    async getProducts() {
      var query = Product;

      if (this.plan != null) {
        query = query.where("plan", this.plan);
      }

      // Show only from user followed categories
      if (this.onlyFollowedCategories) {
        query = query.where("followed_categories", "user");
      }

      query = query
        .page(1)
        .where("has_stock", true)
        .include("store", "plans", "variants")
        .orderBy("-created_at");

      this.products = []; // FIX state not updating

      try {
        let response = await query.get();
        this.products = response.data;

        this.loading = false;
        // console.log("this is current swiper instance object", this.swiper);
      } catch (error) {
        this.$root.displayError(
          error.response ? error.response.data.message : error
        );
        this.loading = false;
      }
    },
    onSwiperEvent(ev) {},
    isActiveSlide(index) {
      return this.swiper.activeIndex == index;
    }
  },
  mounted() {
    this.getProducts();

    // this.swiper.slideTo(3, 1000, false)
  }
};
</script>
