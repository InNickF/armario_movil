<template>
  <div v-if="!loading" class="cursor-pointer avatar-lg p-2" >

    <div class="rounded-circle" @click="openStories">
          <div class="storeImg bg-contain bg-no-repeat rounded-circle mx-auto mt-0 bg-center bg-white"
                  :style="{backgroundImage:getBgImage()}"></div>
        <!-- <img class="avatar-sm-md rounded-circle mx-3" :src="storeFinal.logo_image_thumbnail" /> -->
     <!-- <img class="storeImg img-fluid rounded-circle mx-auto mt-0" :src="storeFinal.logo_image_thumbnail"> -->
      </div>

      
        <!-- <img class="avatar-sm-md rounded-circle mx-3" :src="storeFinal.logo_image_thumbnail" /> -->
  </div>
</template>



<script>

export default {
  components: {},
  props: {
    store: Object
  },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeColor: null,
      activeSize: null,
      loading: true,
      storeFinal: null
    };
  },

  computed: {
    // getStore() {
    //   return JSON.parse(this.store);
    // }
  },
  methods: {
    showModal() {
      // Find parent ref in root then locate component ref
      if (this.$root.$refs["StoriesModal"] && this.$root.$refs["StoriesModal"].$refs["StoriesCarouselModal"]) {
        this.$root.$refs["StoriesModal"].$refs["StoriesCarouselModal"].show(); // Show the modal
        this.$root.$refs["StoriesModal"].setActiveStoreId(this.storeFinal.id) // Set store ID to navigate to correct slide
      } else {
        console.error(refName + ' ref was not found');
      }
    },
    openStories() {
      if(this.storeFinal.latest_story) {
      this.showModal();
      }
    },
    getBgImage() {
      let storeLogo = this.storeFinal.logo_image_thumbnail
      let result = 'url("' + storeLogo + '")';
      return result;
    },
  },
  mounted() {
    // console.log("SingleStoreSmall mounted.", this.storeId);
    // this.getStore();
    if (this.store) {
      this.storeFinal = this.store;
      // console.log('Store', this.storeFinal);
      this.loading = false;
    }

    // if (this.oldReview) {
    //   this.review = this.oldReview;
    // }
  }
};
</script>
