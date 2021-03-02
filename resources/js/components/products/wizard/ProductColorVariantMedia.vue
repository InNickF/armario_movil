<template>
  <div v-if="allowedImages && !loading">
    <div class="row">
      <div
        v-for="(number, index) in allowedImages"
        :key="index"
        class="col-lg-3 col-md-6 col-sm-12"
      >
        <div class="form-group col-sm-12 text-sm">
          <upload-product-single-image
            title="Sube la fotografía de tu producto aquí"
            :field-name="'image_' + number"
            hint="Sube fotos frontales, laterales y traseras del producto"
            @on-add-media="onAddMedia"
            @on-remove-media="onRemoveMedia"
            :old-media="media['image_' + number]"
            @on-updated-help-status="updatedHelpInLocalStorage"
            :showHelp="showImageHelp"
          ></upload-product-single-image>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group col-sm-12">
          <upload-product-single-video
            title="Sube el video del producto aquí"
            :field-name="'video_'+videoNumber"
            hint="Sube aquí un video del producto"
            @on-add-media="onAddMedia"
            @on-remove-media="onRemoveMedia"
            :old-media="media['video_'+videoNumber]"
            @on-updated-help-status="updatedHelpInLocalStorage"
            :showHelp="showVideoHelp"
          ></upload-product-single-video>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    color: "",
    media: null,
    allowedImages: null
  },
  watch: {
    media: {
      handler: function(val, oldVal) {},
      deep: true
    }
  },
  data() {
    return {
      loading: false,
      showImageHelp: true,
      showVideoHelp: true
    };
  },
  computed: {
    videoNumber() {
      return this.allowedImages ? this.allowedImages.length + 1 : null;
    }
  },
  methods: {
    onAddMedia(fieldName, path) {
      // this.$forceUpdate()
      this.$emit("on-add-media", this.color, fieldName, path);
    },
    onRemoveMedia(fieldName) {
      // this.$forceUpdate()
      this.$emit("on-remove-media", this.color, fieldName);
    },
    updatedHelpInLocalStorage(key, value) {
      localStorage[key] = value;
      this[key] = value;
      this.$forceUpdate();
    },
    getShowVideoHelp() {
      if (localStorage.showVideoHelp == undefined) {
        this.showVideoHelp = true;
      } else {
        this.showVideoHelp =
          localStorage.showVideoHelp === "true" ? true : false;
      }
    },
    getShowImageHelp() {
      if (localStorage.showImageHelp == undefined) {
        this.showImageHelp = true;
      } else {
        this.showImageHelp =
          localStorage.showImageHelp === "true" ? true : false;
      }
    }
  },
  mounted() {
    this.getShowImageHelp();
    this.getShowVideoHelp();
  }
};
</script>