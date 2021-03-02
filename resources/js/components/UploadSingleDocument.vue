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
      <div class="form-group col-sm-6 col-md-4 mx-auto d-flex justify-content-center">
        <div>
          <p>Arrastra un archivo o pulsa aquí para subir</p>
        </div>
      </div>
    </vue-dropzone>

    <textarea type="text" v-model="document" :name="fieldName" class="form-control" hidden></textarea>
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
    oldImage: "",
    fieldName: String
  },
  /*
   * The component's data.
   */
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL,
      dropzoneOptions: {
        url: process.env.MIX_APP_URL + "/api/documents/store",
        thumbnailWidth: 200,
        maxFilesize: 10.0,
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        maxFiles: 2,
        acceptedFiles: "image/*,application/pdf",
        renameFile: this.fieldName,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.getToken()
        }
      },
      document: ""
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
      this.document = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
          "manuallyAdded"
        ]
      });
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
      this.document = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
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
    const dropzoneInstance = this.$refs.uploadSingleImage;

    if (this.oldImage != null && this.oldImage.length) {
      var old = JSON.parse(this.oldImage);
      var file = {
        size: 123,
        name: "Archivo de factura",
        type: "image/*,application/pdf",
        path: old
      };
      dropzoneInstance.manuallyAddFile(file, old);
      this.document = JSON.stringify({
        path: this.$refs.uploadSingleImage.dropzone.files[0]["path"],
        manuallyAdded: this.$refs.uploadSingleImage.dropzone.files[0][
          "manuallyAdded"
        ]
      });
    }
  }
};
</script>
