<template>
  <div class="row" id="upload-images">
    <div v-for="(image, key) in images" :key="key" class="col-sm-4 my-2">
      <img v-bind:src="path + '/storage/' + image.path" alt="Image" class="img-fluid img" />
      <div class="btn btn-danger btn-sm delete-image" v-on:click="deleteImage(key)">Delete</div>
    </div>
    <input type="text" v-model="removedImages" name="removed_images" hidden />
  </div>
</template>

<script>
export default {
  props: {
    images: {
      type: Array,
      default: []
    },
    path: String
  },
  /*
   * The component's data.
   */
  data() {
    return {
      //   images: this.images,
      removedImages: []
    };
  },

  methods: {
    deleteImage(key) {
      this.removedImages.push(this.images[key].id);
      this.$delete(this.images, key);
    }
  },

  mounted() {}
};
</script>
