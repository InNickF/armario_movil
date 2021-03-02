<template>
  <div class="container-fluid">
      {{slides}}
    <div class="row" v-for="(slide, index) in slides" :key="index">
      <div class="col-12">
        <div class="card mb-2">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label class="text-weight-bold text-primary" for="title">
                  Titulo:
                  <input type="text" class="form-control" v-model="slide.title">
                </label>
              </div>
              <div class="col-md-6">
                <label class="text-weight-bold text-primary" for="link">
                  Enlace:
                  <input type="text" class="form-control" v-model="slide.link">
                </label>
              </div>

               <upload-single-image title="Cambiar imagen de slide" class="btn-cambiar-foto"
                :old-image="slide.image"
                @on-image-uploaded="slide.image = $event"
                field-name="image">
              </upload-single-image>

              <div class="col-md-6">
                <div class="d-flex">
                  <div>
                    <button class="btn btn-link text-danger btn-sm">Eliminar slide</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button class="btn btn-primary" @click.prevent="addSlide">
        Agregar slide
    </button>
  </div>
</template>
<script>
export default {
  props: {
    oldSlides: Array
  },
  data() {
    return {
      slides: []
    };
  },
  methods: {
      addSlide() {
          this.slides.push({
              title: null,
              image: null
          })
      },
      onImageUploaded(image, slide) {
          slide.image = image
      }
  },
  mounted() {
      if(this.oldSlides) {
          this.slides = JSON.parse(this.oldSlides);
      }
  }
};
</script>