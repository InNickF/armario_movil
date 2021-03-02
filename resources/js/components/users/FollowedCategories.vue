<template>
  <div>
    <div class="container my-4">
      <div class="row">
        <div
          class="col followed-category-toggle text-center mb-4"
          v-for="(category, index) in parentCategories"
          :key="index"
        >
          <a
            href="#anchor-subcategories"
            class="followed-category-icon border rounded-circle d-flex align-items-center justify-content-center avatar-md p-4 cursor-pointer mx-auto mb-2"
            :class="{'active': isActive(category)}"
            @click="select(category)"
          >
            <div class="position-absolute mx-auto" v-if="category.isFollowed">
              <i class="fa fa-check text-white"></i>
            </div>

            <inline-svg
              @error="handleSvgError"
              :src="category.icon_image"
              width="150"
              height="150"
              :aria-label="category.name"
              class="img-fluid cat-icon-svg"
            ></inline-svg>

            <!-- <img :src="category.icon_image" alt class="img-fluid" /> -->
          </a>
          <h6 class="text-sm text-primary">{{category.name}}</h6>
        </div>
      </div>

      <div id="anchor-subcategories" class="row" v-if="childCategories.length">
        <div class="col-12 text-center mt-3 mb-4">
          <div class="text-primary h4">
            Elige las
            <span
              class="font-weight-bold"
            >subcategorías de la categoría {{activeCategory.name}}</span> que más te interesen
          </div>
        </div>
        <div
          class="col followed-category-toggle text-center"
          v-for="(category, index) in childCategories"
          :key="index"
        >
          <div
            class="followed-category-icon border rounded-circle d-flex align-items-center justify-content-center avatar-md p-4 cursor-pointer mx-auto mb-2"
            :class="{'active': category.isFollowed}"
            @click="toggleFollow(category)"
          >
            <div class="position-absolute mx-auto" v-if="category.isFollowed">
              <i class="fa fa-check text-white text-lg"></i>
            </div>

            <!-- <inline-svg
              :src="category.icon_image"
              @loaded="svgLoaded()"
              @unloaded="svgUnloaded()"
              @error="svgLoadError()"
              width="150"
              height="150"
              fill="black"
              aria-label="My image"
            ></inline-svg>-->

            <inline-svg
              :src="category.icon_image"
              width="150"
              height="150"
              :aria-label="category.name"
              class="img-fluid cat-icon-svg"
            ></inline-svg>

            <!-- <img :src="category.icon_image" class="img-fluid image-svg" /> -->
          </div>
          <h6 class="text-sm text-primary">{{category.name}}</h6>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 form-group mt-5 text-center">
          <a
            class="mr-1 btn btn-primary-transparency btn-sm font-weight-bold px-4"
            :href="baseUrl + '/account/profile'"
          >
            <strong>Cancelar</strong>
          </a>
          <button class="ml-1 btn btn-light-green btn-sm px-3" @click="save">
            <strong>Guardar cambios</strong>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    parents: {
      type: Array,
      default: []
    },
    subcategories: Array
  },
  data() {
    return {
      parentCategories: null,
      activeCategory: null,
      baseUrl: process.env.MIX_APP_URL
    };
  },

  methods: {
    handleSvgError(err) {
      console.error(err);
    },
    isActive(category) {
      // If is active tab
      if (this.activeCategory && this.activeCategory.id == category.id) {
        return true;
      }
      // If has selected child
      // if (
      //   this.subcategories.find(sub => sub.parent_id == category.id && sub.isFollowed)
      // ) {
      //   return true;
      // }

      return category.isFollowed;
    },
    toggleFollow(category) {
      category.isFollowed = !category.isFollowed;

      this.parentCategories.forEach(parent => {
        if (
          this.subcategories.find(
            sub => sub.parent_id == parent.id && sub.isFollowed
          )
        ) {
          parent.isFollowed = true;
        } else {
          parent.isFollowed = false;
        }
      });
      this.$forceUpdate();
    },
    select(category) {
      this.activeCategory = category;
    },
    async save() {
      let url = process.env.MIX_API_URL + "/followed_categories";
      let data = [];
      this.subcategories.forEach(c => {
        data[c.id] = c.isFollowed;
      });
      try {
        // Creates or updates review in backend
        var response = await axios.post(url, {
          followed_categories: data
        });
        this.$root.displaySuccess("Se han actualizado tus preferencias", () => {
          window.location = this.baseUrl;
        });
      } catch (error) {
        console.error(error);
        this.$root.displayError(
          "Ha ocurrido un error al guardar tus preferencias"
        );
      }
    }
  },

  mounted() {
    this.parentCategories = this.parents;

    this.parentCategories.forEach(parent => {
      if (
        this.subcategories.find(
          sub => sub.parent_id == parent.id && sub.isFollowed
        )
      ) {
        parent.isFollowed = true;
      } else {
        parent.isFollowed = false;
      }
    });
  },
  computed: {
    childCategories() {
      return this.subcategories.filter(
        c => this.activeCategory && c.parent_id == this.activeCategory.id
      );
    }
  }
};
</script>