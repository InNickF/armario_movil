<template>
  <div>
    <a :href="baseUrl + '/checkout'" id="alertsDropdown" title="Carrito de compras">
      <div class="d-flex align-items-center">
        <div class="nav-link">
          <img :src="icon" class="small-icon-size">
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter">{{ getProductCount() }}</span>
        </div>
        <div class="nav-link pl-0 text-primary d-none d-md-block">${{getCartSubTotal()}}</div>
      </div>
    </a>
  </div>
</template>



<script>
export default {
  async mounted() {
    this.$emit("get-cart");
  },
  props: {
    icon: null,
  },
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL
    };
  },
  methods: {
    getProductCount() {
      return this.$parent.cart.count;
    },
    getCartSubTotal() {
      return this.$parent.cart.subtotal ? this.$parent.cart.subtotal : '0.00';
    }
    // async getCart() {
    //   var response = await axios.get(process.env.MIX_API_URL + "/cart");
    //   this.cart = response.data;
    //   console.log('Cart: ', this.cart);
    // },
  }
};
</script>