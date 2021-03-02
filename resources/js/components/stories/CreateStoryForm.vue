<template>
  <div class>
    <div v-if="!loading">
      <div class="h2 col-lg-12 text-center mt-4 mb-4">
        <strong>Crear oferta de 24 horas</strong>
      </div>

      <div class="form-group col-lg-12 text-sm">
        <label for>Nombre de la oferta (solo tú la verás):</label>
        <input type="text" class="form-control" v-model="title" />
      </div>

      <div class="form-group col-lg-12 text-sm">
        <label>Link de tu producto en Armario Móvil:</label>
        <input type="text" class="form-control" v-model="url" />
        <div class="text-sm mt-1">
          <small>Tus enlaces deben comenzar con http:// ó https://</small>
        </div>
      </div>

      <div class="form-group col-sm-12 text-sm">
        <label>Foto o video de tu oferta:</label>
        <upload-single-media
          ref="uploadArea"
          title="Sube la imagen ó vídeo de la historia"
          field-name="image"
          @on-media-uploaded="mediaUploaded"
        ></upload-single-media>
        <div class="text-sm mt-1">
          <small>Los formatos admitidos son JPG, PNG y MP4, en una resolución de 1080x1440 píxeles.</small>
        </div>
      </div>

      <div class="form-group col-lg-12 text-sm">
        <label for>Texto visualizado de la oferta</label>
        <textarea class="form-control" v-model="body" rows="3"></textarea>
      </div>

      <div class="form-group col-lg-12">
        <button
          :disabled="!isValid"
          class="btn btn-white font-weight-bold btn-flat col-lg-12 mb-3"
          @click="createStory"
        >Crear oferta</button>
        <button
          @click="close()"
          class="btn btn-outline-white font-weight-bold col-lg-12"
          type="button"
          data-dismiss="modal"
        >Cancelar</button>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  methods: {
    createStory() {
      axios
        .post(process.env.MIX_API_URL + "/stories", {
          title: this.title,
          url: this.url,
          image: this.image,
          body: this.body
        })
        .then(
          response => {
            this.loading = true;

            //   Empty fields
            this.title = null;
            this.body = null;
            this.url = null;
            this.image = null;
            this.$refs.uploadArea.clearMedia();
            // this.$refs.uploadSingleImage.dropzone.removeFile(
            //   this.$refs.uploadSingleImage.dropzone.files[0]
            // );

            this.$root.displaySuccess("Tu Oferta 24 Horas ha sido creada");
            this.close();

            this.loading = false;
          },
          error => {
            console.error(error);
            this.$root.displayError(
              "Ha ocurrido un error al crear tu Oferta 24 Horas, por favor vuelve a intentarlo"
            );
          }
        );
    },
    close() {
      this.$root.hideModal("createStoryModal");
    },
    mediaUploaded(path) {
      this.image = path;
    }
  },
  data() {
    return {
      title: null,
      body: null,
      url: null,
      image: null,
      loading: false
    };
  },
  computed: {
    isValid() {
      return this.title != null && this.image != null && this.hasValidURL;
    },
    hasValidURL() {
      return (
        this.url != null &&
        this.url.substring(0, 4) == "http" &&
        this.url.length >= 10
      ); // min 10 digits http://a.b
    }
  },
  mounted() {}
};
</script>