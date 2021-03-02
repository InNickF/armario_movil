<template>
  <div class="w-100">
    <slot></slot>
    <vue-dropzone
      ref="uploadSingleImage"
      id="dropzone"
      :options="dropzoneOptions"
      :use-custom-slot="true"
      v-on:vdropzone-success="imageUploaded"
      v-on:vdropzone-error="errorUploading"
      v-on:vdropzone-removed-file="removedImage"
    >
      <div class="form-group col mx-auto d-flex justify-content-center">
        <div
          v-if="hint && hint.length"
          class="dropzone dropzone-single"
          id="product-main-image-form"
        >
          <div>
            <div class="dz-message needsclick">
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
        <div v-else>
          +-
          <p>Arrastra un archivo o pulsa aquí para subir</p>
        </div>
      </div>
    </vue-dropzone>

    <textarea type="text" v-model="image" :name="fieldName" class="form-control" hidden></textarea>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import {parse, stringify} from 'flatted/esm';


export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  props: {
    title: String,
    oldImage: "",
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
        thumbnailWidth: 200,
        maxFilesize: 10.0,
        addRemoveLinks: false,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        maxFiles: 2,
        acceptedFiles: "image/*",
        renameFile: this.fieldName,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.getToken()
        }
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
      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]['path'],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0]['manuallyAdded']
      });
      this.$emit("on-image-uploaded", file.path);
    },

    errorUploading(file, error, xhr) {
      this.$swal({
        type: "error",
        text: JSON.stringify(error)
      });
      this.$refs.uploadSingleImage.dropzone.removeFile(file);
      this.removedImage(file, error, xhr);
    },

    removedImage() {
      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]['path'],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0]['manuallyAdded']
      });
    },
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    }
  },

  computed: {},

  mounted() {
    // Everything is mounted and you can access the dropzone instance
    const dropzoneInstance = this.$refs.uploadSingleImage;

    if (this.oldImage != null && this.oldImage.length && this.oldImage != 'null') {
      var old = JSON.parse(this.oldImage);
      old = old.includes("http") ? old : this.baseUrl + "/storage/" + old;
      var file = {
        size: 123,
        name: "Imagen principal",
        type: "image/**",
        path: old
      };
      dropzoneInstance.manuallyAddFile(file, old);
      this.image = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]['path'],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0]['manuallyAdded']
      });
    }
  }
};
</script>
