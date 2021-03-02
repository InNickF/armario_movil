<template>
  <div class="product-attribute product-colors mb-3">
    <!-- TABS -->
    <div class="w-100 mb-4" id="myTab" role="tablist">
      <div class="d-flex text-align-center mb-2 flex-wrap">
        <div
          @click="select(variant.id)"
          v-for="(variant, index) in variants"
          :key="index"
          class="mx-2 mb-2"
        >
          <div
            class="circle d-flex justify-content-center align-items-center"
            :class="{active: isActive(variant)}"
          >
            <div class="color-circle" :style="{backgroundColor: variant.color}"></div>
          </div>
        </div>

        <!-- ADD BUTTON -->
        <div>
          <div
            @click="pick()"
            class="mx-2 add-color-circle circle d-flex justify-content-center align-items-center cursor-pointer"
          >
            <div class="color-circle">
              <i class="fa fa-plus"></i>
            </div>
          </div>

          <div>
            <div v-if="showPicker">
              <div @click="showPicker=false" class>
                <span class="text-danger text-sm">
                  Cerrar
                </span>
              </div>
              <div class="z-index-front position-absolute">
              <swatches-picker :palette="colorList" v-model="colors" @input="add"/>
            </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB CONTENTS -->
      <div class="tab-content" id>
        <div
          :class="{'show active': isActive(variant)}"
          class="tab-pane hide"
          v-for="(variant, index2) in variants"
          :key="index2"
        >

         <div
            @click.prevent="remove(variant.id)"
            class="text-underline text-danger cursor-pointer text-sm"
          >
            <span>Eliminar color</span>
          </div>
          <!-- SIZES -->
          <div class="mb-4 pt-2">
            <label class="mb-0">Tallas disponibles en este color</label>
            <wizard-size-select
              :subsubcategory-id="subsubcategoryId"
              :variant-id="variant.id"
              :selected-size="variant.size"
              @select-size="selectSize"
            ></wizard-size-select>
          </div>

          <!-- STOCK  -->
          <div>
            <label for="quantity">Cantidad inicial en stock</label>
            <div class="m-0">
              <div class="btn-group cont-cantidades mb-3" role="group">
                <button
                  type="button"
                  class="btn btn-md bg-grey text-dark btn-cantidades"
                  @click="$emit('on-remove-variant-stock', variant.id)"
                >
                  <i class="fa fa-minus"></i>
                </button>
                <input
                  class="quantity-label text-bold pt-2"
                  v-model="variant.quantity"
                  max="1000"
                  @keyup="onlyNumeric(variant)"
                  name="quantity"
                  v-validate="'required'"
                >

                <button
                  type="button"
                  class="btn btn-md bg-grey text-dark btn-cantidades"
                  @click="$emit('on-add-variant-stock', variant.id)"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Compact } from "vue-color";

export default {
  components: {
    "swatches-picker": Compact
  },
  props: {
    variants: null,
    subsubcategoryId: null
  },
  watch: {
    variants: {
      handler: function(val, oldVal) {
        if (this.variants.length && !this.variants.find(v => v.id == this.activeVariant)) {
          this.activeVariant = this.variants[0].id;
        }
      },
      deep: true
    }
  },
  data() {
    return {
      activeVariant: null,
      showPicker: false,
      colors: [],
      colorList: [
        "#ffffff",
        "#cccccc",
        "#00cadf",
        "#1d66f6",
        "#ff00ff",
        "#ff0000",
        "#f57900",
        "#f8c300",
        "#0ebcbe",
        "#43cb00",
        "#c89673",
        "#ffecc7",
        "#231f20",
        "#666666",
        "#005181",
        "#2e00bc",
        "#662d91",
        "#c1272d",
        "#e24900",
        "#ff9800",
        "#00a385",
        "#47743f",
        "#7d5544",
        "#f5beb8",
      ]
    };
  },
  methods: {
    select(variantId) {
      this.activeVariant = variantId;
    },
    remove(variantId) {
      this.$emit("on-remove-variant", variantId);
    },
    pick() {
      this.showPicker = true;
    },
    add(ev) {
      let newId = this.variants.length
        ? this.variants[this.variants.length - 1].id + 1
        : 1;
      this.$emit("on-add-variant", ev.hex, newId);

      this.activeVariant = newId;
      this.showPicker = false;
    },
    selectSize(variantId, size) {
      this.$emit("on-select-variant-size", variantId, size);
    },
    onlyNumeric(variant) {
      variant.quantity = variant.quantity.replace(/[^0-9]/g, "");
      if (variant.quantity > 1000) {
        variant.quantity = 1000;
      }
    },
    isActive(variant) {
      return this.activeVariant == variant.id;
    }
  },
  mounted() {
    if(this.variants.length) {
      this.activeVariant = this.variants[0].id;
    }
  }
};
</script>
