<template>
  <div class="row">
    <!-- Label Field -->

    <div class="form-group col-sm-6">
      <label for="province" id="province" class="h5 text-primary">Provincia:</label>
      <v-select
        v-model="address.state"
        :options="getStatesList"
        placeholder="Selecciona..."
        @change="updatedDropdowns('state')"
      ></v-select>
    </div>

    <div class="form-group col-sm-6">
      <label for="city" id="city" class="h5 text-primary">Ciudad</label>
      <v-select
        v-model="address.city"
        :options="getCitiesList"
        placeholder="Selecciona..."
        @change="updatedDropdowns('city')"
      ></v-select>
    </div>

    <div class="form-group col-sm-6">
      <label for="city" id="city" class="h5 text-primary">Distrito</label>
      <v-select
        v-model="address.district"
        :options="getDistrictsList"
        placeholder="Selecciona..."
        @change="updatedDropdowns('district')"
      ></v-select>
    </div>

    <div class="form-group col-sm-6">
      <label for="postal_code" id="postal_code" class="h5 text-primary">ZIP:</label>
      <input type="text" class="form-control" name="postal_code" v-model="address.postal_code" />
    </div>

    <!-- Main Street Field -->
    <div class="form-group col-sm-4">
      <label for="street" id="street" class="h5 text-primary">Calle principal:</label>
      <input
        type="text"
        class="form-control"
        name="street"
        v-model="address.street"
        v-validate="'required'"
        @input="onStreetsChanged"
      />
      <p id="error" class="text-danger">{{ errors.first('street') }}</p>
    </div>

    <!-- Property_number Field -->
    <div class="form-group col-sm-4">
      <label
        for="property_number"
        id="property_number"
        class="text-primary font-weight-bold"
      >No. de Residencia:</label>
      <input
        type="text"
        class="form-control bg-transparent"
        name="property_number"
        v-model="address.property_number"
        v-validate="'required'"
      />
      <!-- <p id="error" class="text-danger mb-0">{{ errors.first('street') }}</p> -->
    </div>

    <!-- Secondary Street Field -->
    <div class="form-group col-sm-4">
      <label for="street" id="street" class="h5 text-primary">Calle secundaria:</label>
      <input
        type="text"
        class="form-control"
        name="secondary_street"
        v-model="address.secondary_street"
        v-validate="'required'"
        @input="onStreetsChanged"
      />
      <p id="error" class="text-danger">{{ errors.first('secondary_street') }}</p>
    </div>

    <div class="col-12">
      <div class>
        <div class="h5 text-primary">Ubicación</div>
      </div>
      <div v-if="address" class="mb-4 d-block">
        <GmapMap
          ref="mapRef"
          :center="{lat:getLat(), lng:getLng()}"
          :zoom="15"
          style="width: 500px; height: 300px"
          v-if="showMap"
        >
          <GmapMarker
            ref="marker"
            :key="address.id"
            :position="{lat:getLat(), lng:getLng()}"
            :clickable="false"
            :draggable="true"
            @dragend="moveMarker"
          />
        </GmapMap>

        <input type="hidden" name="latitude" v-model="address.latitude" v-validate="'required'" />
        <input type="hidden" name="longitude" v-model="address.longitude" v-validate="'required'" />

        <p id="error" class="text-danger">{{ errors.first('latitude') }}</p>
        <p id="error" class="text-danger">{{ errors.first('longitude') }}</p>
      </div>
    </div>
  </div>
</template><!-- Address Field -->


<script>
import { ValidationProvider } from "vee-validate";
import { mapFields } from "vee-validate";
import Address from "../../models/Address";
var debounce = require("debounce");

export default {
  components: {},
  props: {
    address: Address,
    showMap: true,
    states: null
  },
  data() {
    return {
      mapLoaded: false,
      map: null,
      apiUrl: process.env.MIX_API_URL
    };
  },
  watch: {
    address: {
      handler: function(val, oldVal) {
        this.validate();
      },
      deep: true,
      immediate: true
    }
  },

  methods: {
    getLocation() {
      if (this.address.latitude == null) {
        this.address.latitude = parseFloat(
          process.env.MIX_GOOGLE_MAPS_DEFAULT_LAT
        );
      }
      if (this.address.longitude == null) {
        this.address.longitude = parseFloat(
          process.env.MIX_GOOGLE_MAPS_DEFAULT_LNG
        );
      }

      // console.log("Address: ", this.address);
    },

    getLat() {
      return this.address.latitude != null
        ? this.address.latitude
        : parseFloat(process.env.MIX_GOOGLE_MAPS_DEFAULT_LAT);
    },
    getLng() {
      return this.address.longitude != null
        ? this.address.longitude
        : parseFloat(process.env.MIX_GOOGLE_MAPS_DEFAULT_LNG);
    },
    moveMarker(event) {
      this.$emit(
        "on-change-position",
        this.address,
        event.latLng.lat(),
        event.latLng.lng()
      );
      // this.address.latitude = event.latLng.lat()
      // this.address.longitude = event.latLng.lng()
      // this.validate();
    },
    validate() {
      var valid = true;
      // console.log("validating fields", this.fields);
      Object.keys(this.fields).forEach(field => {
        // console.log('field', this.fields[field]);
        if (!this.fields[field].valid) {
          valid = false;
        }
      });

      if (
        this.address.state == null ||
        !this.address.state.length ||
        this.address.city == null ||
        !this.address.city.length ||
        this.address.district == null ||
        !this.address.district.length
      ) {
        valid = false;
      }

      this.$emit("on-validate", this.address, valid);

      return valid;
    },
    onStreetsChanged: debounce(function(e) {
      this.geocodeAddress();
    }, 600),
    geocodeAddress() {
      var text = this.address.street + ", " + this.address.secondary_street;

      if (this.address.city) {
        text = text + ", " + this.address.city;
      }
      // console.log("Geocode...", text);
      this.geocode(text);
    },
    async geocode(text) {
      axios
        .post(this.apiUrl + "/addresses/geocode", {
          address: text
        })
        .then(
          response => {
            let geocodedAddress = response.data.results;
            this.$emit(
              "on-change-position",
              this.address,
              geocodedAddress[0].geometry.location.lat,
              geocodedAddress[0].geometry.location.lng
            );
          },
          error => {
            console.error(error);
          }
        );
    },
    updatedDropdowns(attributeUpdated) {
      if (this.mapLoaded) {
        if (this.address.district) {
          this.geocode(this.address.district + ", " + this.address.city);
        } else if (this.address.city) {
          this.geocode(this.address.city + ", " + this.address.state);
        } else if (this.address.state) {
          this.geocode(this.address.state);
        }

        switch (attributeUpdated) {
          case "state":
            if (this.address.city) {
              this.address.city = null;
            }
            if (this.address.district) {
              this.address.district = null;
            }
            break;

          case "city":
            if (this.address.district) {
              this.address.district = null;
            }
            break;

          default:
            break;
        }
      }
    }
  },
  updated() {
    this.map = this.$refs.mapRef.$mapObject;

    if (this.map) {
      // console.log("MAP", this.map);
      // this.$refs.mapRef.$mapCreated.then(() => {
      this.mapLoaded = true;
      // });
    }
  },
  mounted() {
    // console.log("Component address form mounted.");
    this.getLocation();
  },
  computed: {
    getStatesList() {
      return Object.keys(this.states);
    },
    getCitiesList() {
      if (
        this.address == undefined ||
        this.address.state == null ||
        !this.address.state.length ||
        this.states[this.address.state] == undefined
      ) {
        return;
      }
      var cities = [];
      this.states[this.address.state].forEach(state => {
        if (cities.indexOf(state.city) < 0) cities.push(state.city);
      });

      return cities;
    },
    getDistrictsList() {
      if (
        this.address == undefined ||
        this.address.city == null ||
        !this.address.city.length ||
        this.states[this.address.state] == undefined
      ) {
        return;
      }
      var districts = this.states[this.address.state]
        .filter(state => {
          return state.city == this.address.city;
        })
        .map(d => d.district);

      return districts;
    }
  }
};
</script>
