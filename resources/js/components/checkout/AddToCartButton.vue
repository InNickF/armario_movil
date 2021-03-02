<template>
  <div
    class="d-flex flex-column flex-xl-row flex-wrap justify-content-between justify-content-sm-start align-items-start align-items-xl-center"
  >
    <div>
      <div
        class="btn-group cont-cantidades mb-0 mt-3 mt-xl-0"
        role="group"
        aria-label="Basic example"
      >
        <button
          type="button"
          class="btn btn-md bg-light-grey-2 text-primary btn-cantidades"
          @click="decreaseQuantity()"
        >
          <i class="fa fa-minus"></i>
        </button>

        <label class="quantity-label text-bold border-0 pt-2">{{quantity}}</label>
        <button
          type="button"
          class="btn btn-md bg-light-grey-2 text-primary btn-cantidades"
          @click="increaseQuantity()"
        >
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>

    <div>
      <div class="ml-0 ml-xl-2 mt-3 mt-xl-0">
        <button
          :disabled="!variant"
          class="btn btn-strong-pink-2 btn-block font-weight-bold px-4"
          @click="$emit('add-to-cart', {product:product, qty:quantity, variant: variant})"
        >Comprar</button>
      </div>

      <input v-if="variant" type="hidden" v-model="quantity" :max="variant.quantity" />
      <div v-else>
        <p class="text-danger">
          <small>Selecciona la talla para comprar</small>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import Product from "../../models/Product";

export default {
  props: {
    product: null,
    variant: null
  },
  watch: {
    variant: function(newVal, oldVal) {
      if (this.variant) {
        if (this.quantity > this.variant.quantity)
          this.quantity = this.variant.quantity; // RESET QUANTITY
      }
    }
  },
  data() {
    return {
      quantity: 1
    };
  },
  methods: {
    increaseQuantity() {
      if (this.quantity < this.variant.quantity) {
        this.quantity++;
      }
    },
    decreaseQuantity() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    }
  }
};
</script>