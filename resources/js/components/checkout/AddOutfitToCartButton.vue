<template>
  <div class="d-flex flex-wrap align-items-center">
    <div>
      <div class="btn-group cont-cantidades my-3" role="group" aria-label="Basic example">
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
      <div class="ml-2">
        <button
          :disabled="!variants"
          class="btn btn-strong-pink-2 btn-block font-weight-bold"
          @click="$emit('add-to-cart', {outfit:outfit, qty:quantity, variants: getVariants})"
        >{{ loadingCart ? 'Cargando...' : 'Comprar' }}</button>
      </div>

      <input v-if="variants" type="hidden" v-model="quantity" />
      <div v-else>
        <p class="text-danger">
          <small>Selecciona los colores y tallas para comprar</small>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import Outfit from "../../models/Outfit";

export default {
  props: {
    outfit: null,
    variants: null
  },
  watch: {
    variants: function(newVal, oldVal) {
      // * If quantity exceeds maximum, reduce to that
      if (this.quantity > this.getMaximumQuantity) {
        this.quantity = this.getMaximumQuantity;
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
      if (this.quantity < this.getMaximumQuantity) {
        this.quantity++;
      }
    },
    decreaseQuantity() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    }
  },
  computed: {
    getMaximumQuantity() {
      let max;
      let varHighestQuantity = this.variants.forEach(v => {
        if (max == null || v.quantity < max) {
          max = v.quantity;
        }
      });
      return max ? max : 1;
    },
    getVariants() {
      return this.variants;
    },
    loadingCart() {
      return this.$store.getters.loadingCart;
    }
  }
};
</script>