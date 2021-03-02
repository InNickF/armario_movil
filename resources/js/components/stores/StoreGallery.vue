<template>
  <div>
    <div class="row mt-5">
      <!-- Gallery Grid -->
      <div class="col-12">
        <h3 class="text-primary">Galería de imágenes</h3>

        <div class="row text-center no-gutters">
          <div
            v-for="(imageUrl, index) in images"
            :key="index"
            class="col-4 p-1"
          >
            <div class="bg-light img-square">
              <VuePureLightbox :thumbnail="imageUrl" :images="[imageUrl]" class="img img-responsive full-width">
                <!-- <div v-slot:loader>Cargando...</div> -->
                <!-- <div v-slot:content="{ url: { link, alt } }">
                  <img :src="link" :alt="alt" />
                  <div
                    class="bg-center bg-cover w-100 height-md"
                    :style="{backgroundImage: getBgImage(link)}"
                  ></div>
                </div> -->
              </VuePureLightbox>

            </div>
          </div>

          <div v-if="loading">Cargando...</div>
          <button @click="getMore()" v-if="!loading && showMoreBtn" class="btn btn-default">Ver más</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VuePureLightbox from "vue-pure-lightbox";
import styles from 'vue-pure-lightbox/dist/VuePureLightbox.css'

export default {
  components: {
    VuePureLightbox
  },
  props: {
    storeProp: null
  },
  data() {
    return {
      page: 1,
      images: [],
      showMoreBtn: true,
      loading: false,
      store: null,
      swiperOption: {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        }
      }
    };
  },
  methods: {
    async getImages() {
      try {
        this.loading = true;
        let response = await axios.get(
          process.env.MIX_API_URL +
            "/stores/gallery/" +
            this.store.id +
            "?page=" +
            this.page
        );
        response = response.data.data; // real response object from server, contains pagination data

        let images = Object.values(response.data);

        this.images = [...this.images, ...images];

        if (response.current_page == response.last_page) {
          this.showMoreBtn = false;
        }

        this.loading = false;
      } catch (error) {
        console.error(error);
      }
    },
    getBgImage(imageUrl) {
      let result = 'url("' + imageUrl + '")';
      return result;
    },
    getMore() {
      this.page++;
      this.getImages();
    }
  },
  mounted() {
    this.store = this.storeProp;
    this.getImages();
  }
};
</script>