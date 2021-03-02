<template>
  <div class="w-100">
    <slot></slot>

    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="0"
      controls
      indicators
      background="transparent"
      class="b-carousel-slide-h-100"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <div class="h3 text-center">Recomendaciones para fotografías</div>
      <b-carousel-slide caption img-blank img-alt="Blank image" class="h-100">
        <div class="d-flex h-100 align-items-center justify-content-center">
          <div class="text-center text-white">
            <h3>Tamaño recomendado</h3>
            <p>El tamaño mînimo recomendado para subir tus imágenes verticales de 772px de ancho por 1080px de largo.</p>

            <img :src="baseUrl + '/images/icons/wizard/size-grid.svg'" alt class="img-md" />
          </div>
        </div>
      </b-carousel-slide>

      <b-carousel-slide caption img-blank img-alt="Blank image">
        <div class="d-flex h-100 align-items-center justify-content-center">
          <div class="text-center text-white">
            <h3>Producto</h3>
            <p>El producto debe ocupar un 85% de la imagen que vas a subir</p>

            <img :src="baseUrl + '/images/icons/wizard/product-grid.svg'" alt class="img-md" />
          </div>
        </div>
      </b-carousel-slide>

      <b-carousel-slide caption img-blank img-alt="Blank image">
        <div class="d-flex h-100 align-items-center justify-content-center">
          <div class="text-center text-white">
            <h3>Fondos</h3>
            <p>Se recomienda usar fondos grises claro (RGB 230, 230, 230)</p>

            <img :src="baseUrl + '/images/icons/wizard/bg-grid.svg'" alt class="img-md" />
          </div>
        </div>
      </b-carousel-slide>
    </b-carousel>

    <div class="mt-4 text-center d-md-flex align-items-center justify-content-center">
      <button @click.prevent="prev()" class="btn btn-outline-white btn-sm mx-3 my-1">Anterior</button>
      <button @click.prevent="next()" class="btn btn-outline-white btn-sm mx-3 my-1">Siguiente</button>
      <button @click.prevent="close()" class="btn btn-outline-white btn-sm mx-3 my-1">Cerrar</button>
    </div>
  </div>
</template>

<script>
// import { swiper, swiperSlide } from "vue-awesome-swiper";

export default {
  // components: {
  //   swiper,
  //   swiperSlide
  // },
  data() {
    return {
      slide: 0,
      sliding: null,
      baseUrl: process.env.MIX_APP_URL,
      swiperOption: {
        pagination: {
          el: ".swiper-pagination"
        }
        // some swiper options/callbacks
        // 所有的参数同 swiper 官方 api 参数
        // ...
      }
    };
  },
  methods: {
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
    next() {
      this.slide += 1;
    },
    prev() {
      this.slide -= 1;
    },
    close() {
      this.$emit("on-close-popup");
    },
    callback(ev) {}
  }
};
</script>