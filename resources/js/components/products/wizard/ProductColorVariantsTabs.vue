<template>
  <div class="row">
    <div v-if="media" class="col-12">
      <div
        class="col-12 product-attribute product-colors my-3 d-flex flex-wrap justify-content-center"
      >
        <div v-for="color in getMediaKeys" :key="color" class>
          <div
            class="circle mx-1 d-flex justify-content-center align-items-center cursor-pointer"
            :class="{active: isActive(color)}"
            @click="select(color)"
          >
            <div class="color-circle" :style="{backgroundColor: color}"></div>
          </div>
        </div>
      </div>
      <div v-for="(color) in getMediaKeys" :key="'A' + color" class="col-12">
        <product-color-variant-media
          v-show="isActive(color)"
          :color="color"
          :media="media[color]"
          @on-add-media="onAddColorMedia"
          @on-remove-media="onRemoveColorMedia"
          :allowed-images="allowedImages"
        ></product-color-variant-media>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    media: null,
    allowedImages: null
  },
  watch: {
    media: {
      handler: function(val, oldVal) {
        if (!this.media[this.selectedColor]) {
          this.selectedColor = this.getMediaKeys[0];
        }
      },
      deep: true
    }
  },
  data() {
    return {
      selectedColor: null
    };
  },
  methods: {
    select(color) {
      this.selectedColor = color;
    },
    isActive(color) {
      return this.selectedColor == color;
    },
    onAddColorMedia(color, fieldName, path) {
      // * Emit event just passing the vars to ProductWizard
      this.$emit("on-add-color-media", color, fieldName, path);
    },
    onRemoveColorMedia(color, fieldName) {
      // * Emit event just passing the vars to ProductWizard
      this.$emit("on-remove-color-media", color, fieldName);
    }
  },
  computed: {
    getMediaKeys() {
      let keys = Object.keys(this.media);
      return keys;
    }
  },
  mounted() {
    this.selectedColor = this.getMediaKeys[0];
  }
};
</script>