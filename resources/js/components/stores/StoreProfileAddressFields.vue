<template>
  <div class="container-fluid p-0">
    <div class="row" v-if="address">
      <div class="form-group col-sm-12 my-3">
        <label for="province" id="province" class="h6 text-primary font-weight-bold">* País:</label>
        <v-select
          class="v-select-border-primary"
          v-model="address.country_code"
          :options="getCountriesList"
          placeholder="Selecciona..."
          v-validate="'required'"
        ></v-select>
        <input
          type="text"
          v-model="address.country_code"
          name="address[country_code]"
          required
          class="transparent"
        />
      </div>

      <div class="form-group col-sm-6 my-3">
        <label for="province" id="province" class="h6 text-primary font-weight-bold">* Provincia:</label>
        <v-select
          class="v-select-border-primary"
          v-model="address.state"
          :options="getStatesList"
          placeholder="Selecciona..."
          @change="updatedDropdowns('state')"
          v-validate="'required'"
        ></v-select>
        <input
          type="text"
          v-model="address.state"
          name="address[state]"
          required
          class="transparent"
        />
      </div>

      <div class="form-group col-sm-6 my-3">
        <label for="city" id="city" class="h6 text-primary font-weight-bold">* Ciudad</label>
        <v-select
          class="v-select-border-primary"
          v-model="address.city"
          :options="getCitiesList"
          placeholder="Selecciona..."
          @change="updatedDropdowns('city')"
          v-validate="'required'"
        ></v-select>
        <input type="text" v-model="address.city" name="address[city]" required class="transparent" />
      </div>

      <div class="form-group col-sm-6 my-3">
        <label for="city" id="city" class="h6 text-primary font-weight-bold">* Distrito</label>
        <v-select
          class="v-select-border-primary"
          v-model="address.district"
          :options="getDistrictsList"
          placeholder="Selecciona..."
          @change="updatedDropdowns('district')"
          v-validate="'required'"
        ></v-select>
        <input
          type="text"
          v-model="address.district"
          name="address[district]"
          required
          class="transparent"
        />
      </div>

      <div class="form-group col-sm-6 my-3">
        <label
          for="address[postal_code]"
          id="postal_code"
          class="h6 text-primary font-weight-bold"
        >ZIP:</label>
        <input
          type="text"
          class="form-control"
          name="address[postal_code]"
          v-model="address.postal_code"
          
        />
      </div>

      <!-- Main Street Field -->
      <div class="form-group col-sm-4 my-3">
        <label for="street" id="street" class="h6 text-primary font-weight-bold">* Calle principal:</label>
        <input
          type="text"
          class="form-control"
          name="address[street]"
          v-model="address.street"
          v-validate="'required'"
          @input="onStreetsChanged"
          required
        />
        <p id="error" class="text-danger mb-0">{{ errors.first('street') }}</p>
      </div>

      <!-- Property_number Field -->
      <div class="form-group col-sm-4 my-3">
        <label
          for="property_number"
          id="property_number"
          class="text-primary font-weight-bold mb-1"
        >* No. de Residencia:</label>
        <input
          type="text"
          class="form-control bg-transparent"
          name="address[property_number]"
          v-model="address.property_number"
          v-validate="'required'"
          @input="onStreetsChanged"
          required
        />
        <!-- <p id="error" class="text-danger mb-0">{{ errors.first('street') }}</p> -->
      </div>

      <!-- Secondary Street Field -->
      <div class="form-group col-sm-4 my-3">
        <label for="street" id="street" class="h6 text-primary font-weight-bold">* Calle secundaria:</label>
        <input
          type="text"
          class="form-control"
          name="address[secondary_street]"
          v-model="address.secondary_street"
          v-validate="'required'"
          @input="onStreetsChanged"
          required
        />
        <p id="error" class="text-danger mb-0">{{ errors.first('secondary_street') }}</p>
      </div>

      <div class="form-group col-sm-12 my-3">
        <label
          for="reference"
          id="reference"
          class="text-primary font-weight-bold"
        >* Referencia física de tu tienda:</label>
        <input
          placeholder="”Edificio azul, 2 psio, oficina 203”."
          type="text"
          class="form-control"
          name="address[reference]"
          v-model="address.reference"
          v-validate="'required'"
          @input="onStreetsChanged"
          required
        />
      </div>

      <div class="col-12 my-3">
        <div class>
          <div class="text-primary font-weight-bold">* Selecciona el lugar exacto de tu tienda</div>
        </div>

        <div class="mb-4 d-block">
          <GmapMap
            ref="mapRef"
            :center="{lat:address.latitude, lng:address.longitude}"
            :zoom="15"
            style="width: 100%; height: 300px"
          >
            <GmapMarker
              ref="marker"
              :key="address.id"
              :position="{lat:address.latitude, lng:address.longitude}"
              :clickable="false"
              :draggable="true"
              @dragend="moveMarker"
            />
          </GmapMap>

          <input
            type="hidden"
            name="address[latitude]"
            v-model="address.latitude"
            v-validate="'required'"
          />
          <input
            type="hidden"
            name="address[longitude]"
            v-model="address.longitude"
            v-validate="'required'"
          />

          <p id="error" class="text-danger">{{ errors.first('latitude') }}</p>
          <p id="error" class="text-danger">{{ errors.first('longitude') }}</p>
        </div>
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
    oldAddress: Object,
    states: null
  },
  data() {
    return {
      mapLoaded: false,
      map: null,
      apiUrl: process.env.MIX_API_URL,
      address: new Address({
        latitude: null,
        longitude: null
      })
    };
  },
  // watch: {
  //   store: {
  //     handler: function(val, oldVal) {
  //       console.log("------- Watch triggered new: %s, old: %s", val, oldVal);
  //       this.validate();
  //     },
  //     deep: true,
  //     immediate: true
  //   }
  // },

  methods: {
    getLocation() {
      if (this.address == null || this.address.latitude == null) {
        this.address.latitude = parseFloat(
          process.env.MIX_GOOGLE_MAPS_DEFAULT_LAT
        );
      }
      if (this.address == null || this.address.longitude == null) {
        this.address.longitude = parseFloat(
          process.env.MIX_GOOGLE_MAPS_DEFAULT_LNG
        );
      }

      // console.log("Address: ", this.address);
    },

    moveMarker(event) {
      console.log(
        "moveMarker",
        this.address,
        event.latLng.lat(),
        event.latLng.lng()
      );

      this.address.latitude = event.latLng.lat();
      this.address.longitude = event.latLng.lng();
      this.$forceUpdate();
      // this.validate();
    },
    // validate() {
    //   var valid = true;
    //   // console.log("validating fields", this.fields);
    //   Object.keys(this.fields).forEach(field => {
    //     // console.log('field', this.fields[field]);
    //     if (!this.fields[field].valid) {
    //       valid = false;
    //       console.error(
    //         "Invalid address a field is not valid: " + JSON.stringify(field)
    //       );
    //     }
    //   });

    //   if (
    //     this.address.state == null ||
    //     !this.address.state.length ||
    //     this.address.city == null ||
    //     !this.address.city.length ||
    //     this.address.district == null ||
    //     !this.address.district.length
    //   ) {
    //     valid = false;
    //   }

    //   return valid;
    // },
    onStreetsChanged: debounce(function(e) {
      this.geocodeAddress();
    }, 600),
    geocodeAddress() {
      var text = this.address.street;

      if (this.address.secondary_street) {
        text = text + ", " + this.address.secondary_street;
      }

      if (this.address.property_number) {
        text = text + ", " + this.address.property_number;
      }

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
            if (!response.data.results.length) {
              return;
            }

            let geocodedAddress = response.data.results[0];

            this.address.latitude = geocodedAddress.geometry.location.lat;
            this.address.longitude = geocodedAddress.geometry.location.lng;
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
      // this.$refs.mapRef.$mapCreated.then(() => {
      this.mapLoaded = true;
      // });
    }
  },
  mounted() {
    if (this.oldAddress) {
      this.address = this.oldAddress;
    }

    this.address.country_code = "ECUADOR";

    if (!this.address.latitude) {
      this.address.latitude = parseFloat(
        process.env.MIX_GOOGLE_MAPS_DEFAULT_LAT
      );
    }

    if (!this.address.longitude) {
      this.address.longitude = parseFloat(
        process.env.MIX_GOOGLE_MAPS_DEFAULT_LNG
      );
    }
    // this.getLocation();
  },
  computed: {
    getCountriesList() {
      return ["ECUADOR"];
    },
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
