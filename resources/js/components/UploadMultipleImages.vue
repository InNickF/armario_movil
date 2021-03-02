<template>
  <div class="w-100">
    <slot></slot>
    <vue-dropzone
      ref="uploadMultipleImages"
      id="dropzone"
      :options="dropzoneOptions"
      :use-custom-slot="true"
      v-on:vdropzone-success="imageUploaded"
      v-on:vdropzone-error="errorUploading"
      v-on:vdropzone-removed-file="removedImage"
      class="m-auto"
    >
      <div class="form-group col mx-auto d-flex justify-content-center">
        <div class="dropzone dropzone-single" id="product-main-image-form">
          <div class="dz-message needsclick">
            <h4>{{ title }}</h4>
            <br />
            <p>Arrastra archivos aquí o CLICK para subir</p>
            <small
              class="note needsclick"
            >Estas son las fotos que se verán el el apartado de tu tienda llamado «Sobre sonotros»</small>
          </div>
          <div class="fallback">
            <input name="file" type="file" />
          </div>
        </div>
      </div>
    </vue-dropzone>

    <textarea type="text" v-model="images" name="images" class="form-control" hidden></textarea>
    <textarea
      type="text"
      v-model="getRemovedFiles"
      name="removed_images"
      class="form-control"
      hidden
    ></textarea>
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
    oldImages: "",
    limit: Number
  },
  /*
   * The component's data.
   */
  data() {
    return {
      dropzoneOptions: {
        url: process.env.MIX_API_URL + "/images/store",
        thumbnailWidth: 150,
        maxFilesize: 10.0,
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar",
        dictFileTooBig:
          "Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB",
        dictMaxFilesExceeded: "No se permite subir más imágenes",
        maxFiles: this.limit,
        acceptedFiles: "image/*",
        renameFile: "product_images",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.getToken()
        }
      },
      removedImages: [],
      images: []
    };
  },

  methods: {
    imageUploaded(file, response) {
      // console.log("image uploaded");
      file.path = response.data[0];
      this.images = JSON.stringify(
        this.$refs.uploadMultipleImages.dropzone.files
      );
    },

    errorUploading(file, error, xhr) {
      this.$swal({
        type: "error",
        text: error
      });
      this.$refs.uploadMultipleImages.dropzone.removeFile(file);
      this.removedImage(file, error, xhr);
    },

    removedImage(file) {
      this.images = JSON.stringify(
        this.$refs.uploadMultipleImages.dropzone.files
      );

      this.removedImages.push(file);
    },
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    }
  },

  computed: {
    getRemovedFiles() {
      return JSON.stringify(this.removedImages);
    }
  },

  mounted() {
    // Everything is mounted and you can access the dropzone instance
    const dropzoneInstance = this.$refs.uploadMultipleImages;

    var old = this.oldImages;

    if (old != null && old.length) {
      old.forEach(path => {
        var file = {
          size: 123,
          name: "Imagen complementaria",
          type: "image/**",
          path: path
        };
        dropzoneInstance.manuallyAddFile(file, path);
        this.images = JSON.stringify(dropzoneInstance.dropzone.files);
      });
    }
  }
};
</script>
