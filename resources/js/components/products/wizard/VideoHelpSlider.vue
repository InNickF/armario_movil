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
      style
      class="b-carousel-slide-h-100"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <div class="h3 text-center">Recomendaciones para videos</div>
      <b-carousel-slide caption img-blank img-alt="1">
        <div class="d-flex h-100 align-items-center justify-content-center">
          <div class="text-center text-white">
            <h3>Tamaño recomendado</h3>
            <p>El tamaño mînimo recomendado para subir el video vertical de tu producto es de 450px de ancho por 800px de largo.</p>

            <img :src="baseUrl + '/images/icons/wizard/size-grid.svg'" alt class="img-md" />
          </div>
        </div>
      </b-carousel-slide>

      <b-carousel-slide caption img-blank img-alt="2">
        <div class="d-flex h-100 align-items-center justify-content-center">
          <div class="text-center text-white">
            <h3>Producto</h3>
            <p>Cargar videos formato mp4, máximo de duración de 15 segundos, tamaño máximo de 64MG</p>

            <img :src="baseUrl + '/images/icons/wizard/video-grid.svg'" alt class="img-md" />
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
export default {
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
    callback(ev) {},
    close() {
      this.$emit("on-close-popup");
    }
  }
};
</script>