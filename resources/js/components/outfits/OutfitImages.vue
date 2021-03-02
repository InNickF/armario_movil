<template>
  <div>
    <!-- ActiveImages = 'outfit' -->
    <div v-if="activeImages == 'outfit'">
      <div>
        <div
          class="overflow-auto no-scrollbar img-style--container__mb"
          style="height:600px"
          :id="'colorImages_' + outfit.id + activeImages"
        >
          <!-- Thumbnails -->
          <div class="card-body z-999 position-absolute top-0">
            <div class="text-left">
              <div class="product-gallery my-2">
                <div
                  v-for="(image, index2) in outfit.media"
                  :key="index2"
                  class="img-sm thumb-singleProduct my-2 o-hidden rounded border-2px border-white"
                  v-scroll-to="{
                        el: '#image_' + outfit.id + activeImages + index2,
                        container: '#colorImages_' + outfit.id + activeImages,
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
                    v-if="!isVideo(image)"
                    class="img-fluid cursor-pointer"
                    :src="image"
                    :alt="outfit.name"
                  />
                  <div class="img-fluid cursor-pointer" v-else>
                    <!-- <canvas id="videoCanvas" class="w-">
                    Tu navegador no soporta esta característica
                    </canvas>-->

                    <video class="w-100 rounded" :src="image" id="videoElement">
                      <!-- <source :src="image" type="video/mp4">Your browser does not support the video tag. -->
                    </video>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Scrollable images big -->
          <div
            v-for="(image, indexB) in outfit.media"
            :key="indexB"
            :id="'image_' + outfit.id + activeImages + indexB"
            class="img-style__mb"
          >
            <div
              v-if="!$root.isVideo(image)"
              class="card-singleproduct card bg-cover bg-center single-product-detail-img-card o-hidden bg-transition bg-transparent border-0"
              :style="{backgroundImage: getBgImage(image)}"
            ></div>

            <div class="img-fluid cursor-pointer" v-else>
              <video class="w-100 rounded" :src="image" id="videoElement" controls></video>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ActiveImages = 'products' -->
    <div v-if="activeImages == 'products'">
      <div>
        <div
          class="overflow-auto no-scrollbar img-style--container__mb"
          style="height:600px"
          :id="'colorImages_' + outfit.id + activeImages"
        >
          <div class="card-body z-999 position-absolute top-0">
            <div class="text-left">
              <div class="product-gallery my-2">
                <!-- Thumbnails -->
                <div
                  v-for="(product, index2) in outfit.products"
                  :key="index2"
                  class="img-sm thumb-singleProduct my-2 o-hidden rounded border-2px border-white"
                  v-scroll-to="{
                        el: '#image_product_' + product.id + activeImages + index2,
                        container: '#colorImages_' + outfit.id + activeImages,
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
                    :src="product.main_image_thumbnail"
                    :alt="product.name"
                  />
                </div>
              </div>
            </div>
          </div>
          <!-- Scrollable images big -->
          <div
            v-for="(product, indexB) in outfit.products"
            :key="indexB"
            :id="'image_product_' + product.id + activeImages + indexB"
            class="img-style__mb"
          >
            <div
              class="card-singleproduct card bg-cover bg-center single-product-detail-img-card o-hidden bg-transition bg-transparent border-0"
              :style="{backgroundImage: getBgImage(product.main_image_thumbnail)}"
            ></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Switch Product/Outfit images buttons -->
    <div class="d-flex justify-content-end">
      <div class="d-flex my-2 bg-light rounded-pill">
        <div class>
          <button
            @click="activeImages = 'outfit'"
            class="btn btn-sm btn-transparent text-primary"
            :class="{'btn-strong-pink text-white': activeImages == 'outfit'}"
          >Outfit</button>
        </div>
        <div class>
          <button
            @click="activeImages = 'products'"
            class="btn btn-sm btn-transparent text-primary"
            :class="{'btn-strong-blue text-white': activeImages == 'products'}"
          >Productos</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Outfit from "../../models/Outfit";
const mime = require("mime");

export default {
  components: {},
  props: {
    outfit: Outfit,
    activeProduct: null
  },
  watch: {
    activeColor: function(newVal, oldVal) {
      // watch it
      // console.log("Active color changed: ", newVal, " | was: ", oldVal);
      this.activeImageKey = "image_1";
    }
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      activeImageKey: "image_1",
      activeProductImageIndex: 0,
      activeImages: "outfit"
    };
  },

  computed: {},
  methods: {
    getBgImage(mediaItem) {
      // console.log(this.activeImageKey);

      if (this.activeImageKey.includes("video")) {
        return "";
      }
      let result = 'url("' + mediaItem + '")';
      // console.log(result);
      return result;
    },
    changeBigImage(key) {
      this.activeImageKey = key;
      // this.captureVideo();
    },
    changeBigProductImage(key) {
      this.activeProductImageIndex = key;
      // this.captureVideo();
    },
    isVideo(url) {
      // Remove everything to the last slash in URL
      // extension = url.substr(1 + url.lastIndexOf("/"));

      // // Break URL at ? and take first part (file name, extension)
      // url = url.split("?")[0];

      // // Sometimes URL doesn't have ? but #, so we should aslo do the same for #
      // url = url.split("#")[0];

      // Now we have only extension
      let type = mime.getType(url);
      return type && type.includes("video");
    }
    // captureVideo() {
    //   var canvas = document.getElementById("videoCanvas");
    //   var video = document.getElementById("videoElement");
    //   console.log(canvas, video);
    //   canvas
    //     .getContext("2d")
    //     .drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
    // }
  },
  mounted() {
    // this.captureVideo();
    // console.log("OutfitImages mounted.");
    // console.log("active color", this.activeColor);
  }
};
</script>
