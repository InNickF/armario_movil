<template>
  <div class="row">
    <!-- Label Field -->
    <div v-if="!address.skip_document" class="col-12">
      <!-- <div class="h2 text-left text-primary mb-4">Nueva dirección de envío</div> -->
      <div class="row">
        <div class="form-group col-sm-6" v-if="address">
          <label
            for="label"
            id="label"
            class="text-primary font-weight-bold"
          >* Etiqueta (ej: Trabajo):</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="label"
            v-model="address.label"
            placeholder
            v-validate="'required'"
          />
          <!-- <p id="error" class="text-danger mb-0">{{ errors.first('label') }}</p> -->
        </div>

        <div class="form-group col-sm-6">
          <label for="state" id="state" class="text-primary font-weight-bold">* Provincia:</label>
          <v-select
            v-model="address.state"
            :options="getStatesList"
            placeholder="Selecciona..."
            @change="updatedDropdowns('state')"
            name="state"
            v-validate="'required'"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <div class="form-group col-sm-6">
          <label for="city" id="city" class="text-primary font-weight-bold">* Ciudad:</label>
          <v-select
            v-model="address.city"
            :options="getCitiesList"
            placeholder="Selecciona..."
            @change="updatedDropdowns('city')"
            name="city"
            v-validate="'required'"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <div class="form-group col-sm-6">
          <label for="district" id="district" class="text-primary font-weight-bold">* Distrito:</label>
          <v-select
            v-model="address.district"
            :options="getDistrictsList"
            placeholder="Selecciona..."
            @change="updatedDropdowns('district')"
            name="district"
            v-validate="'required'"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <div class="form-group col-sm-6">
          <label
            for="postal_code"
            id="postal_code"
            class="text-primary font-weight-bold"
          >ZIP (Opcional):</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="postal_code"
            v-model="address.postal_code"
          />
        </div>

        <div class="col-12"></div>

        <!-- Main Street Field -->
        <div class="form-group col-sm-4">
          <label for="street" id="street" class="text-primary font-weight-bold">* Calle principal:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="street"
            v-model="address.street"
            v-validate="'required'"
            @input="onStreetsChanged"
          />
          <!-- <p id="error" class="text-danger mb-0">{{ errors.first('street') }}</p> -->
        </div>

        <!-- Property_number Field -->
        <div class="form-group col-sm-4">
          <label
            for="property_number"
            id="property_number"
            class="text-primary font-weight-bold"
          >* No. de Residencia:</label>
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
          <label for="street" id="street" class="text-primary font-weight-bold">* Calle secundaria:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="secondary_street"
            v-model="address.secondary_street"
            v-validate="'required'"
            @input="onStreetsChanged"
          />
          <!-- <p id="error" class="text-danger mb-0">{{ errors.first('secondary_street') }}</p> -->
        </div>

        <div class="form-group col-sm-12">
          <label for="reference" id="reference" class="text-primary font-weight-bold">* Referencia:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="reference"
            v-model="address.reference"
          />
        </div>

        <div class="col-12">
          <div class="mb-2">
            <div
              class="text-primary font-weight-bold"
            >* Ubicación: marca tu dirección exacta en el mapa</div>
          </div>
          <div v-if="address" class="mb-4 d-block">
            <GmapMap
              ref="mapRef"
              :center="{lat:getLat(), lng:getLng()}"
              :zoom="15"
              style="width: 100%; height: 300px"
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

            <input type="hidden" name="latitude" v-model="address.latitude" />
            <input type="hidden" name="longitude" v-model="address.longitude" />
          </div>
        </div>

        <div class="form-group col-12">
          <div class="d-flex align-items-center">
            <div class="form-check abc-checkbox abc-checkbox-primary">
              <input
                type="checkbox"
                class="form-check-input radio-custom checkbox"
                name="is_primary"
                v-model="address.is_primary"
              />
              <label
                class="form-check-label text-primary radio-custom-label"
                for="is_primary"
                id="is_primary"
              ></label>
            </div>
            <div
              class="text-primary text-sm pt-1 ml-2 font-weight-bold"
            >Marcar como dirección de envío principal</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


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
    fields: {
      handler: function(val, oldVal) {
        this.validate();
      },
      deep: true,
      immediate: true
    }
  },

  methods: {
    validate() {
      let valid = true;
      Object.keys(this.fields).forEach(field => {
        if (!this.fields[field].valid) {
          valid = false;
          console.error(
            "Invalid address a field is not valid: " + JSON.stringify(field)
          );
        }
      });

      this.$emit("on-validate", this.address, valid);

      return valid;
    },
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
    onStreetsChanged: debounce(function(e) {
      this.geocodeAddress();
    }, 600),
    geocodeAddress() {
      var text = this.address.street + ", " + this.address.secondary_street;

      if (this.address.city) {
        text = text + ", " + this.address.city;
      }
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
    if (this.$refs.mapRef && this.$refs.mapRef.$mapObject) {
      this.map = this.$refs.mapRef.$mapObject;
      // this.$refs.mapRef.$mapCreated.then(() => {
      this.mapLoaded = true;
      // });
    }
  },
  mounted() {
    if (this.showMap) {
      this.getLocation();
    }
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
