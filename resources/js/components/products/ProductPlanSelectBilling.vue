<template>
  <div>
    <!-- CONSUMIDOR FINAL SWITCH -->
    <div class="form-group col-12 d-flex justify-content-center">
      <label class="font-weight-bold text-primary mr-2">Consumidor final</label>
      <toggle-button
        color="#181b48"
        :labels="{checked: 'Sí', unchecked: 'No'}"
        v-model="isConsumidorFinal"
      />
    </div>

    <div class="col-8 mx-auto" v-if="!isConsumidorFinal">
      <div
        v-for="address in addresses"
        class="card rounded border-0 mb-2"
        :class="{'border-primary': address.is_primary}"
        :key="address.id"
      >
        <div class="card-body py-2">
          
            <div class="text-left text-primary font-weight-bold mb-0 mt-1">
              <h4>
               {{address.street}} 
                <small
                  v-if="address.is_primary"
                  class="text-sm text-primary mb-3"
                >Predeterminada</small>
              </h4>
            </div>
              <div class="text-sm text-primary mb-3 text-left">
                {{ address.label }}  
              </div>

            <div
              class=""
              :class="{'': isSelectedAddress(address.id) && !addressIsBeingEdited(address)}"
            >
              <div v-if="isSelectedAddress(address.id)" class="d-flex justify-content-center align-items-between">
                <div class="col-6 pl-0">
                  <button class="pt-2 btn-block btn-primary-gradient btn-sm rounded-lg">Seleccionado</button>
                </div>
                <div class="col-6 pl-0">
                 <button
                  v-if="!addressIsBeingEdited(address)"
                  @click.prevent="editAddress(address)"
                  class="btn-block btn btn-outline-primary btn-sm bg-transparent"
                >Editar</button>
                </div>
              </div>

              <div
                v-if="!addressIsBeingEdited(address) && !isSelectedAddress(address.id)"
                @click.prevent="selectAddress(address)"
                class="d-flex justify-content-center align-items-between"
              >
                <div class="col-6 pl-0">
                  <button class="btn-block btn btn-sm btn-outline-primary bg-transparent">Seleccionar</button>
                </div>
                <div class="col-6 pl-0">
                 <button
                  v-if="!addressIsBeingEdited(address)"
                  @click.prevent="editAddress(address)"
                  class="btn-block btn btn-outline-primary btn-sm bg-transparent"
                >Editar</button>
                </div>
              </div>
            </div>
          

          <billing-fields
            v-if="addressIsBeingEdited(address)"
            :address="address"
            :show-map="showMap"
            :states="states"
            @on-validate="onValidate"
            @on-change-position="onMovePosition"
          ></billing-fields>
          <!-- Submit Field -->
          <div v-if="addressIsBeingEdited(address)" class="form-group col-sm-12">
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="saveAddress(address)"
              :disabled="!address.valid"
            >Guardar cambios</button>
            <button
              type="submit"
              class="btn text-danger btn-link ml-2"
              @click.prevent="deleteAddress(address)"
            >Borrar</button>
            <button
              type="submit"
              class="btn text-primary btn-link ml-2"
              @click.prevent="addressBeingEditedId = null"
            >Cancelar</button>
          </div>
        </div>
      </div>

      <div class="text-left">
        <button
          class="my-3 btn btn-outline-primary btn-sm font-weight-bold btn-sm"
          @click.prevent="addAddress"
          v-bind:class="{'d-none' : !hideForm }"
        >Agregar otra dirección</button>
      </div>

      <div
        class="card border-0 mb-5"
        v-bind:class="{'d-none' : hideForm }"
        v-if="newAddress"
      >
        <div class="card-body">
          <billing-fields
            :address="newAddress"
            :show-map="showMap"
            :states="states"
            @on-validate="onValidate"
            @on-change-position="onMovePosition"
          ></billing-fields>

          <div class="form-group col-sm-12 d-flex">
            <div class="col-6">
            <button
              :disabled="!newAddress.valid"
              type="submit"
              class="btn btn-primary btn-sm btn-block"
              @click.prevent="storeAddress(newAddress)"
            >Crear</button>
            </div>
            <div class="col-6">
            <button class="btn btn-outline-transparent ml-2 btn-sm btn-block" @click.prevent="hideForm = true">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <input name="address_id" type="hidden" v-if="selectedAddress" v-model="selectedAddress.id" />
    </div>

      <input name="is_consumidor_final" type="hidden" v-if="isConsumidorFinal" v-model="isConsumidorFinal" />
    <div class="col-8 mx-auto">
      <div class="text-center mt-4 mb-5">
        <button :disabled="!isConsumidorFinal && !selectedAddress" id="billSubscriptionButton" type="submit" class="btn btn-primary btn-block btn-sm">Continuar</button>
      </div>
    </div>
  </div>
</template>


<script>
import Address from "../../models/Address";

export default {
  props: {},
  /*
   * The component's data.
   */
  data() {
    return {
      selectedAddress: null,
      states: [],
      type: "is_billing",
      addresses: [],
      hideForm: true,
      newAddress: new Address({
        latitude: null,
        longitude: null,
        is_billing: true,
        is_shipping: false
      }),
      addressBeingEditedId: Number,
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      showMap: true,
      filteredAddresses: [],
      isConsumidorFinal: false
    };
  },

  methods: {
    async getAddresses() {
      this.addresses = await Address.where("is_billing", true)
        .where("is_collecting", true)
        .get();

      if (!this.addresses.length) {
        this.hideForm = false;
        return;
      }

      this.addresses.forEach(address => {
        if (address.is_primary == true) {
          this.selectAddress(address);
        }
      });
    },
    async getStates() {
      axios.get(this.apiUrl + "/ubigeos/states").then(
        response => {
          this.states = response.data;
          this.loading = false;
        },
        error => {
          this.$root.displayError(error);
        }
      );
    },
    selectAddress(address) {
      this.selectedAddress = address;
    },
    async deleteAddress(address) {
      // POST /post
      try {
        let deleted = await address.delete();
        this.addresses = this.addresses.filter(
          existingAddress => existingAddress.id != address.id
        );

        if (!this.addresses.length) {
          this.hideForm = false;
        }
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    isSelectedAddress(id) {
      if (this.selectedAddress == null) {
        return false;
      }
      return this.selectedAddress.id == id;
    },
    isGlobalAddressType() {
      return this.$parent.globalType == this.type;
    },
    editAddress(address) {
      this.addressBeingEditedId = address.id;
    },
    addressIsBeingEdited(address) {
      return address.id == this.addressBeingEditedId;
    },
    async storeAddress(newAddress) {
      newAddress["is_billing"] = true;
      newAddress["is_collecting"] = true;
      // let address = new Address(newAddress);
      // POST /post
      try {
        let addressSaved = await newAddress.save();
        addressSaved = addressSaved;
        this.addresses.push(new Address(addressSaved));
        this.makePrimary(addressSaved);
        this.hideForm = true;
        this.newAddress = new Address({
          latitude: null,
          longitude: null,
          is_billing: true,
          is_shipping: false
        });
        this.$root.displaySuccess("Datos de facturación actualizados");
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    addAddress() {
      if (this.type.length) {
        this.newAddress[this.type] = true;
      }

      this.hideForm = false;
    },
    async saveAddress(address) {
      this.addressBeingEditedId = null;
      try {
        let updated = await address.save();
        this.makePrimary(address);
        this.$root.displaySuccess("Datos de facturación actualizados");
        // this.$delete(this.addresses, key);
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    onValidate(address, valid) {
      // console.log("Validating from AddressList", address.id, valid);
      // var exists = this.addresses.find(a => a.id == address.id);

      if (address.id != undefined) {
        this.addresses.forEach(a => {
          if (a.id == address.id) {
            a.valid = valid;
          }
        });
      } else {
        this.newAddress.valid = valid;
      }

      // console.log(this.addresses);
      this.$forceUpdate(); // WOERKS
    },
    onMovePosition(address, lat, lng) {
      // var exists = this.addresses.find(a => a.id == address.id);

      if (address.id != undefined) {
        this.addresses.forEach(a => {
          if (a.id == address.id) {
            // Vue.set(this.addresses, a.id, valid)
            a.latitude = lat;
            a.longitude = lng;
          }
        });
      } else {
        this.newAddress.latitude = lat;
        this.newAddress.longitude = lng;
      }
      this.$forceUpdate(); // WOERKS

      // console.log(this.newAddress);
    },
    makePrimary(address) {
      this.addresses.map(otherAddress => {
        if (address.id !== otherAddress.id) {
          if (address.is_billing == otherAddress.is_billing) {
            otherAddress.cleanPrimary();
          }
          if (address.is_shipping == otherAddress.is_shipping) {
            otherAddress.cleanPrimary();
          }
        }
      });
    }
  },

  mounted() {
    console.log("SelectAddressList Component mounted.", this.newAddress);
    this.getAddresses();
    this.getStates();
    // if(this.type == 'is_shipping') {
    //   this.showMap = true;
    // }
  }
};
</script>