<template>
  <div>
    <a :href="product.url">
      <figure class="card card-product card-border">
        <div class="card-body">
          <div class>
            <img class="rounded mx-auto d-block p-0 img-fluid" :src="product.main_image_thumbnail" />
          </div>
          <figcaption class="info-wrap mt-2">
            <a :href="product.url">
              <span class="text-md title">{{ product.name }}</span>
            </a>

            <p class="text-bold mt-2" v-if="product.store">by {{product.store.name}}</p>

            <!--<p>-->
            <!--Categorías:-->
            <!--<small-->
            <!--v-for="(category, index) in product.categories"-->
            <!--:key="index"-->
            <!--&gt;{{ category.name }}</small>-->
            <!--</p>-->
          </figcaption>
          <div class="bottom-wrap d-flex justify-content-between align-items-center">
            <div class="price-wrap">
              <span :class="'price text-bold h5 color-' + priceColor">$ {{ product.final_price }}</span>
              <del v-if="hasDiscount" class="price-old">{{product.price }}</del>
            </div>
            <!-- price-wrap.// -->
            <!--<div class>-->
            <!--<button class="btn text-danger">-->
            <!--<i class="fa fa-heart"></i>-->
            <!--</button>-->
            <!--</div>-->
          </div>

          <!-- bottom-wrap.// -->
        </div>
      </figure>
    </a>
  </div>
</template>

<script>
export default {
  components: {},
  props: {
    product: ""
  },
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL
    };
  },
  methods: {
    save() {}
  },
  computed: {
    priceColor: function() {
      var d = new Date();
      d.setDate(d.getDate() - 1);
      if (Date.parse(this.product.created_at) > d) {
        return "new";
      }

      return "normal";
    },
    hasDiscount: function() {
      return this.product.final_price < this.product.price;
    }
  },

  mounted() {}
};
</script>
