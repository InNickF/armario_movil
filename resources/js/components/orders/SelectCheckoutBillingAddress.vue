<template>
  <div>
    <div class="row" v-if="!loading">
      <!-- CONSUMIDOR FINAL SWITCH -->
      <div class="form-group col-12 d-flex">
        <label class="font-weight-bold text-primary mr-2">Consumidor final</label>
        <toggle-button
          color="#171a47"
          :labels="{checked: 'Sí', unchecked: 'No'}"
          v-model="isConsumidorFinal"
        />
      </div>

      <div class="col-sm-12" v-if="!isConsumidorFinal">
        <billing-addresses
          :addresses="filterAddresses('is_billing')"
          @delete="deleteAddress"
          @update="updateAddress"
          @store="storeAddress"
          @on-select-address="selectAddress"
          @on-select-global-address="selectGlobalAddress"
          :selected-address="selectedBillingAddress"
          :states="states"
        ></billing-addresses>
      </div>

      <input
        v-if="selectedBillingAddress"
        type="hidden"
        name="billing_address_id"
        v-model="selectedBillingAddress.id"
      />

      <input
        v-if="isConsumidorFinal"
        type="hidden"
        name="is_consumidor_final"
        v-model="isConsumidorFinal"
      />
      <div class="col-12">
        <div class="text-center mb-5">
          <button
            :disabled="(!isConsumidorFinal && !selectedBillingAddress)"
            id="billAndSendButton"
            type="submit"
            class="btn btn-primary btn-block btn-sm"
            @click="sending = true"
            v-show="!sending"
          >Continuar</button>

          <p v-if="sending">Procesando...</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Address from "../../models/Address";

export default {
  /*
   * The component's data.
   */
  data() {
    return {
      addresses: [],
      baseUrl: process.env.MIX_APP_URL,
      states: {},
      apiUrl: process.env.MIX_API_URL,
      loading: true,
      sending: false,
      selectedBillingAddress: null,
      isConsumidorFinal: false
    };
  },

  props: {},

  computed: {},

  methods: {
    async getAddresses() {
      this.addresses = await Address.where("is_paying", true)
        .where("is_billing", true)
        .get();

      if (!this.addresses.length) {
        // If no addresses in profile dont do anything
        return;
      }

      // Select primary as default selected
      this.addresses.forEach(address => {
        if (address.is_primary == true) {
          this.selectAddress(address);
        }
      });

      // If no primary was selected, select first
      if (!this.selectedBillingAddress) {
        this.selectAddress(this.addresses[0]);
      }
    },
    async deleteAddress(address, type) {
      // POST /post
      try {
        let deleted = await address.delete();
        this.addresses = this.addresses.filter(
          existingAddress => existingAddress.id != address.id
        );

        // Unselect address if selcted was deleted
        if (
          this.selectedBillingAddress &&
          this.selectedBillingAddress.id == address.id
        ) {
          this.selectAddress(null);
        }
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    async updateAddress(address) {
      // POST /post
      try {
        let updated = await address.save();
        this.makePrimary(updated);

        // Recalculate billing address if selected was updated
        if (
          this.selectedBillingAddress &&
          this.selectedBillingAddress.id == updated.id
        ) {
          this.selectAddress(updated);
        }

        this.$root.displaySuccess("Datos actualizados");
      } catch (error) {
        this.$root.displayError(error);
      }
    },

    async storeAddress(newAddress, type) {
      newAddress[type] = true;
      newAddress["is_paying"] = true; // paying or collecting

      // let address = new Address(newAddress);
      // POST /post
      try {
        let addressSaved = await newAddress.save();
        this.addresses.push(new Address(addressSaved));
        this.makePrimary(addressSaved);

        // Select the new address
        this.selectAddress(addressSaved);

        this.$root.displaySuccess("Datos guardados");
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    selectAddress(address) {
      this.selectedBillingAddress = address;
    },
    filterAddresses(filter) {
      return this.addresses.filter(address => address[filter] == true);
    },
    selectGlobalAddress(address, type) {
      // this.$emit("on-select-global-address", address, type);
      // if(type == 'is_billing') {
      //   this.$refs.billing_list.addresses.push(address)
      // } else {
      //   this.$refs.billing_list.addresses.push(address)
      // }
      // this.selectedAddresses["is_billing"] = address;
      // this.selectedAddresses["is_billing"] = address;

      this.$emit("on-select-global-address", address, type);
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
    makePrimary(address) {
      this.addresses.map(otherAddress => {
        if (address.id !== otherAddress.id) {
          if (address.is_billing == otherAddress.is_billing) {
            otherAddress.cleanPrimary();
          }
          if (address.is_billing == otherAddress.is_billing) {
            otherAddress.cleanPrimary();
          }
        }
      });
    }
  },

  mounted() {
    this.getAddresses();
    this.getStates();
  }
};
</script>