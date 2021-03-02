<template>
  <div>
    <a v-if="getActiveStore && stories" :href="getActiveStore.url">
      <div class="d-flex align-items-center mb-1">
        <div class="mr-1">
          <img class="img-sm rounded-circle mx-3" :src="getActiveStore.logo_image_thumbnail" />
        </div>

        <div class="text-white">
          <h3 class="h5 font-weight-bold">{{ getActiveStore.name }}</h3>
          <div class="mr-1 text-sm">
            Oferta finaliza
            <timeago class="text-sm" :datetime="stories[activeIndex].expires_at"></timeago>
          </div>
        </div>
      </div>
    </a>
    <!-- Progress bars -->
    <div class="container">
      <div class="row">
        <template v-for="(story, indexA) in stories">
          <div class="col my-2" v-if="activeStoreId == story.store_id" :key="indexA">
            <div class="progress progress-no-trasition">
              <div
                class="progress-bar"
                role="progressbar"
                :aria-valuenow="story.progress"
                :style="{width: story.progress+'%'}"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
          </div>
          <!-- <b-progress
            v-show="activeStoreId == story.store_id"
            :value="story.progress"
            :max="100"
            class="mb-3"
            show-progress
          ></b-progress>-->
        </template>
      </div>
    </div>

    <div v-if="activeIndex != null">
      <b-carousel
        id="carousel-1"
        v-model="activeIndex"
        controls
        :interval="0"
        @sliding-start="onSlideStart"
        @sliding-end="onSlideChange"
      >
        <!-- slides -->
        <b-carousel-slide
          img-blank
          v-for="(story, indexB) in stories"
          :key="indexB"
          class="carousel-caption-no-image"
        >
          <div class="text-center text-white">
            <div
              class="story-img-container d-flex align-items-center justify-content-center rounded"
            >
              <div class="w-100">
                <div class="w-100 cursor-pointer">
                  <img
                    class="w-100 cursor-pointer rounded"
                    :src="story.image"
                    v-if="!$root.isVideo(story.image)"
                  />

                  <video
                    class="w-100 h-100 rounded mb-5"
                    :src="story.image"
                    id="videoElement"
                    :ref="'video_' + indexB"
                    autoplay
                    playsinline
                    loop
                    v-else-if="indexB == activeIndex"
                  >
                    <!-- <source :src="image" type="video/mp4">Your browser does not support the video tag. -->
                  </video>
                  <div class="w-100 h-100 story-body-bg rounded">
                    <div class="story-caption p-2 w-100">
                      <div class="mt-2">
                        <p>{{story.body}}</p>
                        <a
                          @click="saveGAEvent(story)"
                          class="btn btn-primary-gradient my-3"
                          :href="story.url"
                        >Ver oferta</a>

                        <!-- <a
                      v-if="$root.isVideo(story.image)"
                      :href="story.image"
                      class="btn btn-default my-3"
                      target="_blank"
                        >Abrir vídeo</a>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </b-carousel-slide>

        <!-- Optional controls -->
        <!-- <div class="swiper-pagination" slot="pagination"></div> -->
        <!-- <div class="swiper-button-prev" slot="button-prev"></div> -->
        <!-- <div class="swiper-button-next" slot="button-next"></div> -->
        <!-- <div class="swiper-scrollbar" slot="scrollbar"></div> -->
      </b-carousel>
    </div>
  </div>
</template>



<script>
export default {
  components: {},
  props: {
    stores: Array,
    activeStoreId: null
  },
  // watch: {
  //   activeStoreId: {
  //     deep: true,
  //     immediate: true,
  //     handler: function(val, oldVal) {

  //     }
  //   }
  // },

  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      activeColor: null,
      activeSize: null,
      // loading: true,
      storesFinal: null,
      stories: null,
      timeoutId: null,
      activeIndex: null
    };
  },

  computed: {
    // getStoriesFromActiveStore() {
    //   return this.getStories.filter(story => {
    //     return story.store_id == this.activeStoreId;
    //   });
    // },
    // swiper() {
    //   return this.$refs.storiesCarousel.swiper;
    // }
    getActiveStore() {
      if (!this.storesFinal) {
        return null;
      }
      return this.storesFinal.find(s => {
        return s.id == this.activeStoreId;
      });
    }
  },
  methods: {
    getStories() {
      let stories = [];
      if (!this.storesFinal) {
        return stories;
      }
      this.storesFinal.forEach(store => {
        stories = [...stories, ...store.active_stories];
      });
      this.stories = stories;

      let i = 0;
      for (var story of this.stories) {
        if (story.store_id == this.activeStoreId) {
          this.activeIndex = i;
          break;
        }
        i++;
      }
      this.startProgressBar(this.activeIndex, 1);
    },
    // getBgImage() {
    //   let newestStoryImage = this.storeFinal.stories[0].image;
    //   let result = 'url("' + newestStoryImage + '")';
    //   return result;
    // },
    onSlideStart() {
      if (this.timeoutId) {
        clearTimeout(this.timeoutId);
      }
    },
    onSlideChange(ev) {
      // If store changed update progress bars
      if (this.stories[this.activeIndex].store_id != this.activeStoreId) {
        this.$emit("set-store-id", this.stories[this.activeIndex].store_id);
      }

      // Restart progress bar
      this.startProgressBar(this.activeIndex);
    },
    onProgressChange(ev) {},
    isActiveSlide(index) {
      return this.activeIndex == index;
    },
    startProgressBar(activeCarouselIndex, width = 1) {
      let activeStory = this.stories[activeCarouselIndex];
      if (width >= 100 || activeCarouselIndex != this.activeIndex) {
        // Clear if full or if active slide changed
        if (this.timeoutId) {
          clearTimeout(this.timeoutId);

          // Always stop if video
          if (
            this.$refs["video" + activeCarouselIndex] &&
            this.$refs["video" + activeCarouselIndex].length
          ) {
            this.$refs["video_" + activeCarouselIndex][0].stop();
          }

          // Stop if last slide
          if (this.activeIndex + 1 > this.stories.length - 1) {
            return;
          }

          this.activeIndex++;
        }
      } else {
        width++;
        activeStory.progress = width;

        const autoplayTime = 14000 / 100;
        this.timeoutId = setTimeout(
          function() {
            this.startProgressBar(activeCarouselIndex, width);
          }.bind(this),
          autoplayTime
        );
      }
    },
    saveGAEvent(story) {
      this.$ga.event(
        "Oferta 24 horas",
        "Click en Ver Oferta",
        story.title || "Historia sin título",
        story.id,
        {
          hitCallback: function() {
            console.log("ANALYTICS: click on Story");
          }
        }
      );

      this.saveClick(story);
    },
    async saveClick(story) {
      try {
        var response = await axios.post(
          this.apiUrl + "/stories/" + story.id + "/click"
        );
        response = response.data.data;
      } catch (error) {
        console.error(error);
        // this.$root.displayError(error.response.data.message || error.response);
      }
    }
  },
  mounted() {
    if (this.stores) {
      this.storesFinal = this.stores;
    }

    this.getStories();

    // * Swiper is available at this point
    // console.log("this is current swiper instance object", this.swiper);

    // this.swiper.autoplay.running
    // this.swiper.autoplay.start();

    // Progress listener
    // this.swiper.on("progress", function(ev) {

    // });

    // this.loading = false;
  }
};
</script>
