<template>
  <div class="w-100 cont-upload-image">
    <slot></slot>
    <div>
      <vue-dropzone
        ref="uploadSingleVideo"
        id="dropzone"
        :options="dropzoneOptions"
        :use-custom-slot="true"
        v-on:vdropzone-success="videoUploaded"
        v-on:vdropzone-error="errorUploading"
        v-on:vdropzone-removed-file="removedVideo"
        class="m-auto"
      >
        <div class="form-group mx-auto d-flex flex-wrap justify-content-center">
          <div class="dropzone dropzone-single py-0" id="product-main-video-form">
            <div class="dz-message needsclick" v-if="hint.length">
              <img
                :src="baseUrl + '/images/icons/wizard/play-icon.svg'"
                class="img-sm mb-5 mt-3"
                alt
              />
              <h6 class="mt-4">{{title}}</h6>
            </div>
          </div>
        </div>
      </vue-dropzone>

      <textarea type="text" v-model="video" :name="fieldName" class="form-control" hidden></textarea>
      <div class="text-sm my-2">
        <small>
          <span class="font-weight-bold">Recomendación:</span> Sube aquí un video mostrando tu producto
        </small>
      </div>
      <button
        @click.prevent="showHelpModal"
        class="btn btn-sm btn-primary font-weight-bold btn-info"
      >
        <div class>Guía</div>
      </button>

      <div>
        <b-modal modal-class="modal-bg" size="md" ref="videoHelpModal" hide-footer>
          <wizard-video-help-slider @on-close-popup="hideModal"></wizard-video-help-slider>
        </b-modal>
      </div>
    </div>
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
    oldMedia: "",
    fieldName: String,
    hint: ""
  },
  /*
   * The component's data.
   */
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      dropzoneOptions: {
        url: process.env.MIX_APP_URL + "/api/videos/store",
        thumbnailWidth: 200,
        thumbnailHeight: 200,
        thumbnailMethod: "crop",
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        maxFilesize: 20.0,
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

      // Emit event with path and image fieldName
      this.$emit("on-add-media", this.fieldName, file.path);

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
        text: JSON.stringify(error)
      });
      this.$refs.uploadSingleVideo.dropzone.removeFile(file);
      this.removedVideo(file, error, xhr);
    },

    removedVideo() {
      this.$emit("on-remove-media", this.fieldName);

      this.video = JSON.stringify({
        path: this.$refs.uploadSingleVideo.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleVideo.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    },
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    },

    hideModal() {
      this.$refs["videoHelpModal"].hide();
      this.$emit("on-updated-help-status", "showVideoHelp", false);
    },
    showHelpModal() {
      this.$refs["videoHelpModal"].show();
    }
  },

  computed: {},

  mounted() {
    // Everything is mounted and you can access the dropzone instance
    const dropzoneInstance = this.$refs.uploadSingleVideo;

    if (this.oldMedia != null && this.oldMedia.length) {
      var old = this.oldMedia;
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
