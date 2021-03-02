<template>
  <div class="row p-0">
    <!-- Label Field -->
    <div v-if="!address.skip_document" class="col-12 p-0">
      <div class="h2 text-left text-primary mb-4">Nuevos datos de facturación</div>
      <div class="row">
        <div class="form-group col-sm-4" v-if="address">
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

        <div class="form-group col-sm-4">
          <label for="given_name" id="given_name" class="text-primary font-weight-bold">* Nombre:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="given_name"
            v-model="address.given_name"
            v-validate="'required|alpha_spaces'"
          />
          <!-- <p id="error" class="text-danger">{{ errors.first('given_name') }}</p> -->
        </div>

        <div class="form-group col-sm-4">
          <label
            for="family_name"
            id="family_name"
            class="text-primary font-weight-bold"
          >* Apellido:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="family_name"
            v-model="address.family_name"
            v-validate="'required|alpha_spaces'"
          />
          <!-- <p id="error" class="text-danger">{{ errors.first('family_name') }}</p> -->
        </div>

        <div class="form-group col-sm-4">
          <label
            for="city"
            id="city"
            class="text-primary font-weight-bold"
          >* Tipo de identificación:</label>
          <v-select
            v-model="address.document_type"
            :options="['RUC', 'CÉDULA']"
            name="document_type"
            placeholder="Selecciona..."
            v-validate="'required'"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <!-- Main Street Field -->
        <div class="form-group col-sm-4">
          <label
            for="document_number"
            id="document_number"
            class="text-primary font-weight-bold"
          >RUC ó CC:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="document_number"
            v-model="address.document_number"
            v-validate="'required|numeric|min:10|max:13'"
            pattern="[0-9]+"
            maxlength="13"
          />
          <!-- <p id="error" class="text-danger">{{ errors.first('document_number') }}</p> -->
        </div>

        <div class="form-group col-sm-4">
          <label for="email" id="email" class="text-primary font-weight-bold">* Email:</label>
          <input
            type="email"
            class="form-control bg-transparent"
            name="email"
            v-model="address.email"
            v-validate="'required|email'"
          />
        </div>

        <div class="form-group col-sm-4">
          <label for="phone" id="phone" class="text-primary font-weight-bold">* Teléfono celular:</label>
          <input
            type="text"
            class="form-control bg-transparent"
            name="phone"
            v-model="address.phone"
            v-validate="'required|numeric'"
            pattern="\+?[0-9 ]+"
            maxlength="10"
            minlength="10"
          />
        </div>

        <div class="form-group col-sm-4">
          <label for="province" id="province" class="text-primary font-weight-bold">* Provincia:</label>
          <v-select
            v-model="address.state"
            :options="getStatesList"
            placeholder="Selecciona..."
            v-validate="'required'"
            name="state"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <div class="form-group col-sm-4">
          <label for="city" id="city" class="text-primary font-weight-bold">* Ciudad:</label>
          <v-select
            v-model="address.city"
            :options="getCitiesList"
            placeholder="Selecciona..."
            v-validate="'required'"
            name="city"
            class="v-select-border-primary"
          ></v-select>
        </div>

        <div class="col-12"></div>

        <!-- Main Street Field -->
        <div class="form-group col-sm-12">
          <label for="street" id="street" class="text-primary font-weight-bold">* Dirección:</label>

          <textarea
            class="form-control bg-transparent"
            name="street"
            rows="3"
            v-model="address.street"
            v-validate="'required'"
          ></textarea>
          <!-- <p id="error" class="text-danger mb-0">{{ errors.first('street') }}</p> -->
        </div>

        <div class="form-group col-12">
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
            >Marcar como principal</label>
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
        }
      });

      this.$emit("on-validate", this.address, valid);

      return valid;
    }
  },
  updated() {},
  mounted() {},
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
    }
  }
};
</script>