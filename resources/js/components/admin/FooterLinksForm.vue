<template>
  <div class="container-fluid">
    <div class="row" v-for="(link, index) in links" :key="index">
      <div class="col-12">
        <div class="card mb-2">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label class="text-weight-bold text-primary" for="title">
                  Titulo:
                  <input type="text" class="form-control" v-model="link.title" required />
                </label>
              </div>
              <div class="col-md-6">
                <label class="text-weight-bold text-primary" for="link">
                  Enlace:
                  <input type="text" class="form-control" v-model="link.link" required />
                </label>
              </div>

              <div class="col-md-6">
                <div class="d-flex">
                  <div>
                    <button
                      @click.prevent="removeLink(index)"
                      class="btn btn-link text-danger btn-sm"
                    >Eliminar link</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" :name="fieldName" v-model="linksFormatted" />
    <button class="btn btn-primary" @click.prevent="addlink">Agregar link</button>
  </div>
</template>
<script>
export default {
  props: {
    linksProp: null,
    fieldName: null
  },
  data() {
    return {
      links: []
    };
  },
  methods: {
    addlink() {
      this.links.push({
        title: null,
        link: null
      });
    },
    removeLink(index) {
      this.links = this.links.filter((link, i) => i != index);
    }
  },
  mounted() {
    if (this.linksProp) {
      this.links = Object.keys(this.linksProp).map(title => {
        return {
          title: title,
          link: this.linksProp[title]
        };
      });
    }
  },
  computed: {
    linksFormatted() {
      let result = {};

      this.links.forEach(link => {
        result[link.title] = link.link;
      });
      return JSON.stringify(result);
    }
  }
};
</script>