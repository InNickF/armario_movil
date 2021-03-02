<template>
  <div>
    <div v-for="(colorImages, colorName) in product.colors_media" :key="colorName">
      <!-- Group of images from active color -->
      <div
        v-if="activeColor == colorName"
        class="overflow-auto no-scrollbar img-style--container__mb"
        style="height:600px"
        :id="'colorImages_' + product.id + removeHashtag(colorName)"
      >
        <!-- Thumbnails -->
        <div class="card-body z-999 position-absolute top-0">
          <div class="text-left">
            <div class="product-gallery my-2">
              <div
                v-for="(image, index2) in colorImages"
                :key="index2"
                class="img-sm thumb-singleProduct my-2 o-hidden rounded border-2px border-white"
                v-scroll-to="{
                        el: '#image_' + product.id + removeHashtag(colorName) + index2,
                        container: '#colorImages_' + product.id + removeHashtag(activeColor),
                        duration: 500,
                        easing: 'ease',
                        offset: 0,
                        force: true,
                        cancelable: true,
                        onStart: false,
                        onDone: false,
                        onCancel: false,
                        x: false,
                        y: true
                    }"
              >
                <img

                  class="img-fluid cursor-pointer"
                  :src="product.colors_media_thumbs[colorName][index2]"
                  :alt="product.name"
                />
                <!-- <div class="img-fluid cursor-pointer" v-else>
                  <video class="w-100 rounded" :src="image" id="videoElement"></video>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- Scrollable images big -->
        <div
          v-for="(image, indexB) in colorImages"
          :key="indexB"
          :id="'image_' + product.id + removeHashtag(colorName) + indexB"
          class="img-style__mb"
        >
          <div
            v-if="!$root.isVideo(image)"
            class="card-singleproduct card bg-cover bg-center single-product-detail-img-card o-hidden bg-transition bg-transparent border-0"
            :style="{backgroundImage: getBgImage(image)}"
          ></div>

          <div class="img-fluid cursor-pointer" v-else>
            <video class="w-100 rounded" :poster="product.colors_media_thumbs[colorName][indexB]" id="videoElement" controls>
              <source :src="image" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Product from "../../models/Product";
var debounce = require("debounce");

export default {
  components: {},
  props: {
    product: Product,
    activeColor: null,
    isActiveSlide: false
  },
  watch: {
    activeColor: function(newVal, oldVal) {
      this.activeColorImageKey = "image_1";
    }
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      activeColorImageKey: "image_1"
    };
  },

  computed: {},
  methods: {
    getBgImage(image) {
      let result = 'url("' + image + '")';
      return result;
    },
    removeHashtag(txt) {
      return txt.replace('#', '')
    }
  },

  mounted() {}
};
</script>
