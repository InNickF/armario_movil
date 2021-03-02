<template>
  <div class="w-100">
    <slot></slot>
    <vue-dropzone
      ref="uploadSingleVideo"
      id="dropzone"
      :options="dropzoneOptions"
      :use-custom-slot="true"
      v-on:vdropzone-success="videoUploaded"
      v-on:vdropzone-error="errorUploading"
      v-on:vdropzone-removed-file="removedVideo"
    >
      <div class="form-group col-sm-6 col-md-4 mx-auto d-flex justify-content-center">
        <div class="dropzone dropzone-single" id="product-main-video-form">
          <div class="dz-message needsclick" v-if="hint.length">
            <h4>{{title}}</h4>
          </div>
          <div class="fallback">
            <input name="file" type="file" />
          </div>
          <small>
            <strong>Recomendación:</strong>
            {{hint}}
          </small>
        </div>
      </div>
    </vue-dropzone>

    <textarea type="text" v-model="video" :name="fieldName" class="form-control" hidden></textarea>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  props: {
    title: String,
    oldVideo: "",
    fieldName: String,
    hint: ""
  },
  /*
   * The component's data.
   */
  data() {
    return {
      // baseUrl: process.env.MIX_APP_URL,
      dropzoneOptions: {
        url: process.env.MIX_APP_URL + "/api/videos/store",
        thumbnailWidth: 200,
        maxFilesize: 20.0,
        addRemoveLinks: false,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        maxFiles: 2,
        acceptedFiles: ".mp4",
        renameFile: this.fieldName,
        timeout: 0,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.getToken()
        }
      },
      video: ""
    };
  },

  methods: {
    videoUploaded(file, response) {
      // console.log("video uploaded");
      if (this.$refs.uploadSingleVideo.dropzone.files.length > 1) {
        // Has prev file, remove it if new video is valid size
        // console.log("has prev");
        // console.log(this.$refs.uploadSingleVideo.dropzone);
        if (file.size <= this.dropzoneOptions.maxFilesize * 1024 * 1024) {
          this.$refs.uploadSingleVideo.dropzone.removeFile(
            this.$refs.uploadSingleVideo.dropzone.files[0]
          );
        }
      }

      file.path = response.data[0];
      this.video = JSON.stringify({
        path: this.$refs.uploadSingleVideo.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleVideo.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    },

    errorUploading(file, error, xhr) {
      this.$swal({
        type: "error",
        title: "Ups!",
        text: JSON.stringify(error)
      });
      this.$refs.uploadSingleVideo.dropzone.removeFile(file);
      this.removedVideo(file, error, xhr);
    },

    removedVideo() {
      this.video = JSON.stringify({
        path: this.$refs.uploadSingleVideo.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleVideo.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    },
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    }
  },

  computed: {},

  mounted() {
    // Everything is mounted and you can access the dropzone instance
    const dropzoneInstance = this.$refs.uploadSingleVideo;

    if (this.oldVideo != null && this.oldVideo.length) {
      var old = JSON.parse(this.oldVideo);
      var file = {
        size: 123,
        name: "Video principal",
        type: "video/**",
        path: old
      };
      dropzoneInstance.manuallyAddFile(file, old);
      this.video = JSON.stringify({
        path: this.$refs.uploadSingleVideo.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleVideo.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    }
  }
};
</script>
