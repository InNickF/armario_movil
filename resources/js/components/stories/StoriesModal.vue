<template>
  <div>
    <b-modal
      modal-class="modal-bg stories-carousel-modal"
      size="md"
      ref="StoriesCarouselModal"
      hide-footer
      @show="onShow"
      @hide="onHide"
    >
      <div v-if="storesFinal">
        <stories-carousel
          ref="storiesCarousel"
          :stores="storesFinal"
          :active-store-id="getActiveStoreId"
          @set-store-id="setActiveStoreId"
        ></stories-carousel>
      </div>
      <div v-else>No se han encontrado historias</div>
    </b-modal>
  </div>
</template>



<script>
export default {
  components: {},
  props: {
    stores: null
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeColor: null,
      activeSize: null,
      loading: true,
      storesFinal: [],
      activeStoreId: null
    };
  },

  computed: {
    getStories() {
      let stories = [];
      if (!this.storesFinal) {
        return stories;
      }
      this.storesFinal.forEach(store => {
        store.active_stories.forEach(story => {
          stories.push(story);
        });
      });
      return stories;
    },
    getActiveStoreId() {
      return this.activeStoreId;
    }
  },
  methods: {
    getBgImage() {
      let newestStoryImage = this.storeFinal.stories[0].image;
      let result = 'url("' + newestStoryImage + '")';
      return result;
    },
    onShow(event) {
      if (this.$refs.storiesCarousel && this.$refs.storiesCarousel.timeoutId) {
        clearTimeout(this.$refs.storiesCarousel.timeoutId);
      }
    },
    onHide(event) {
      if (this.$refs.storiesCarousel && this.$refs.storiesCarousel.timeoutId) {
        clearTimeout(this.$refs.storiesCarousel.timeoutId);
      }
    },
    setActiveStoreId(id) {
      this.activeStoreId = id;
    }
  },
  mounted() {
    if (this.stores) {
      this.storesFinal = this.stores.map(store => {
        store.active_stories.map(story => {
          story.progress = 0; // Set default
          return story;
        });
        return store;
      });
    }

    this.loading = false;
  }
};
</script>
