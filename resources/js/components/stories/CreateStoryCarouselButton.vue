<template>
  <div>
    <div @click="showModal" class="cursor-pointer">
      <div class="card-image text-center">
        <div class="img-24 bg-gradient p-2px rounded-circle my-3 mx-auto position-relative">
          <div
            class="w-100 h-100 bg-center bg-cover mx-auto rounded-circle border-white border-2px bg-white"
            :style="{backgroundImage:getBgImage()}"
          ></div>
          <!-- <img class="avatar-sm-md rounded-circle mx-3" :src="storeFinal.logo_image_thumbnail" /> -->
          <div class="position-absolute bg-gradient create-story-icon rounded-circle">
            <i class="fa fa-plus-circle text-white"></i>
          </div>
        </div>

        <!-- <img class="avatar-sm-md rounded-circle mx-3" :src="store.logo_image_thumbnail" /> -->
      </div>
      <div class="w-100 card-body text-sm text-primary h-100 py-0 font-weight-bold">Crear historia</div>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    store: Object
  },
  methods: {
    showModal() {
      this.$root.showModal("createStoryModal");
    },
    hideModal() {
      this.$root.hideModal("createStoryModal");
    },
    getBgImage() {
      let image = this.store.logo_image_thumbnail;
      let result = 'url("' + image + '")';
      return result;
    }
  },
  data() {
    return {
      title: "",
      url: "",
      image: null
    };
  },
  mounted() {}
};
</script>
