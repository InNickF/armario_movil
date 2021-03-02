<template>
  <div class="w-100 cont-upload-image">
    <slot></slot>

    <div>
      <vue-dropzone
        ref="uploadSingleImage"
        id="dropzone"
        :options="dropzoneOptions"
        :use-custom-slot="true"
        v-on:vdropzone-success="imageUploaded"
        v-on:vdropzone-error="errorUploading"
        v-on:vdropzone-removed-file="removedImage"
        class="m-auto"
      >
        <div class="form-group mx-auto d-flex flex-wrap justify-content-center">
          <div class="dropzone dropzone-single py-0" id="product-main-image-form">
            <div class="dz-message needsclick" v-if="hint.length">
              <img
                :src="baseUrl + '/images/icons/wizard/camera-icon.svg'"
                class="img-sm mb-5 mt-3"
                alt
              />
              <h6 class="mt-4">{{ title }}</h6>
            </div>
            <div class="fallback">
              <input name="file" type="file" />
            </div>
            <!-- <small>
              <strong>Recomendación:</strong>
              {{ hint }}
            </small>-->
          </div>
        </div>
      </vue-dropzone>
    </div>

    <textarea type="text" v-model="image" :name="fieldName" class="form-control" hidden></textarea>
    <div class="text-sm my-2">
      <small>
        <span class="font-weight-bold">Recomendación:</span> Sube fotos frontales, laterales y traseras de tu producto
      </small>
    </div>
    <button @click.prevent="showHelpModal" class="btn btn-primary btn-sm btn-info font-weight-bold">
      <div class>Guía</div>
    </button>

    <div>
      <b-modal modal-class="modal-bg" size="md" ref="imageHelpModal" hide-footer>
        <wizard-image-help-slider @on-close-popup="hideModal"></wizard-image-help-slider>
      </b-modal>
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
        url: process.env.MIX_APP_URL + "/api/images/store",
        thumbnailWidth: 157,
        thumbnailHeight: 197,
        thumbnailMethod: "crop",
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        maxFilesize: 10.0,
        maxFiles: 2,
        acceptedFiles: "image/*",
        renameFile: this.fieldName,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.getToken()
        }
        //         Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drop files here to upload";
        // Dropzone.prototype.defaultOptions.dictFallbackMessage = "Your browser does not support drag'n'drop file uploads.";
        // Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
        // Dropzone.prototype.defaultOptions.dictFileTooBig = "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.";
        // Dropzone.prototype.defaultOptions.dictInvalidFileType = "You can't upload files of this type.";
        // Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
        // Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancel upload";
        // Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Are you sure you want to cancel this upload?";
        // Dropzone.prototype.defaultOptions.dictRemoveFile = "ELIMINAR";
        // Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "You can not upload any more files.";
      },
      image: ""
    };
  },

  methods: {
    imageUploaded(file, response) {
      // console.log("image uploaded");
      if (this.$refs.uploadSingleImage.dropzone.files.length > 1) {
        // Has prev file, remove it if new image is valid size
        // console.log("has prev");
        // console.log(this.$refs.uploadSingleImage.dropzone);
        if (file.size <= this.dropzoneOptions.maxFilesize * 1024 * 1024) {
          this.$refs.uploadSingleImage.dropzone.removeFile(
            this.$refs.uploadSingleImage.dropzone.files[0]
          );
        }
      }

      file.path = response.data[0];

      // Emit event with path and image fieldName
      this.$emit("on-add-media", this.fieldName, file.path);

      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    },

    errorUploading(file, error, xhr) {
      var msg =
        "Error subiendo archivo, asegúrate que sea una imagen de hasta 5MB";
      if (
        error.errors &&
        error.errors.length &&
        error.errors[0].file &&
        error.errors[0].file.length
      ) {
        msg = error.errors[0].file[0];
      }
      console.error(JSON.stringify(error));
      this.$swal({
        type: "error",
        text: msg
      });
      this.$refs.uploadSingleImage.dropzone.removeFile(file);
      this.removedImage(file, error, xhr);
    },

    removedImage() {
      this.$emit("on-remove-media", this.fieldName);
      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    },
    removeImage() {
      this.image = "";
      this.$refs.uploadSingleImage.dropzone.removeAllFiles();
    },
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    },
    hideModal() {
      this.$refs["imageHelpModal"].hide();
      this.$emit("on-updated-help-status", "showImageHelp", false);
    },
    showHelpModal() {
      this.$refs["imageHelpModal"].show();
    }
  },

  computed: {},

  mounted() {
    // Everything is mounted and you can access the dropzone instance
    const dropzoneInstance = this.$refs.uploadSingleImage;

    if (this.oldMedia != null && this.oldMedia.length) {
      var old = this.oldMedia;
      var file = {
        size: 123,
        name: "Imagen principal",
        type: "image/**",
        path: old
      };
      dropzoneInstance.manuallyAddFile(file, old);
      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    }
  }
};
</script>
