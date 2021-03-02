<template>
  <div>
    <div class="row" v-if="user">
      <div class="form-group col-sm-6 mt-3 mb-4">
        <label for="province" id="province" class="text-primary font-weight-bold">Provincia:</label>
        <v-select
          class="v-select-border-primary"
          v-model="user.state"
          :options="getStatesList"
          placeholder="Selecciona..."
          @change="updatedDropdowns('state')"
          v-validate="'required'"
        ></v-select>
        <input type="text" name="state" v-model="user.state" required class="transparent" />
      </div>

      <div class="form-group col-sm-6 mt-3 mb-4">
        <label for="city" id="city" class="text-primary font-weight-bold">Ciudad</label>
        <v-select
          class="v-select-border-primary"
          v-model="user.city"
          :options="getCitiesList"
          placeholder="Selecciona..."
          @change="updatedDropdowns('city')"
          v-validate="'required'"
        ></v-select>
        <input type="text" name="city" v-model="user.city" required class="transparent" />
      </div>
    </div>
  </div>
</template>


<script>
import User from "../../models/User";
var debounce = require("debounce");

export default {
  components: {},
  props: {
    userProp: Object,
    showMap: true,
    ubigeos: Array
  },
  data() {
    return {
      mapLoaded: false,
      map: null,
      apiUrl: process.env.MIX_API_URL,
      user: {
        type: User,
        default: null
      }
    };
  },
  // watch: {
  //   user: {
  //     handler: function(val, oldVal) {
  //       console.log("------- Watch triggered new: %s, old: %s", val, oldVal);
  //     },
  //     deep: true,
  //     immediate: true
  //   }
  // },

  methods: {
    updatedDropdowns(attributeUpdated) {
      switch (attributeUpdated) {
        case "state":
          if (
            !this.ubigeos.find(
              ubi => ubi.city == this.user.city && ubi.state == this.user.state
            )
          ) {
            this.user.city = null;
          }
          break;

        default:
          break;
      }
    }
  },
  mounted() {
    // console.log("Component address form mounted.");
    this.user = this.userProp;
  },
  computed: {
    getStatesList() {
      var states = this.ubigeos.map((ubigeo, i) => ubigeo.state);

      return [...new Set(states)];
    },
    getCitiesList() {
      if (!this.user || !this.user.state) {
        return;
      }
      var cities = this.ubigeos
        .filter(ubi => ubi.state == this.user.state)
        .map((ubigeo, i) => ubigeo.city);

      return [...new Set(cities)];
    }
  }
};
</script>