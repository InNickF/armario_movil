<template>
  <div>
    <div class="row p-0">
      <div class="col-sm-12 p-0">
        <billing-addresses
          :addresses="filterAddresses('is_billing')"
          @delete="deleteAddress"
          @update="updateAddress"
          @store="storeAddress"
          :states="states"
          :show-select-button="false"
        ></billing-addresses>
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
      apiUrl: process.env.MIX_API_URL
    };
  },

  props: {
    filter: String,
    states: null
  },

  computed: {},

  methods: {
    filterAddresses(filter) {
      return this.addresses.filter(address => address[filter] == true);
    },
    async getAddresses() {
      if (this.filter.length) {
        this.addresses = await Address.where(this.filter, true).get();
      } else {
        this.addresses = await Address.get();
      }
      if (!this.addresses.length) {
        this.hideForm = false;
      }
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
        // this.$delete(this.addresses, key);
      } catch (error) {
        this.displayError(error);
      }
    },
    async updateAddress(address) {
      // POST /post
      try {
        let updated = await address.save();

        this.cleanOtherPrimary(updated);

        this.displaySuccess("Dirección actualizada");
        // this.$delete(this.addresses, key);
      } catch (error) {
        this.displayError(error);
      }
    },

    async storeAddress(newAddress) {
      if (this.filter.length) {
        newAddress[this.filter] = true;
      }

      let address = new Address(newAddress);
      // POST /post
      try {
        let addressSaved = await address.save();

        this.addresses.push(addressSaved);

        this.cleanOtherPrimary(addressSaved);

        this.hideForm = true;
        this.displaySuccess("Dirección guardada");
      } catch (error) {
        this.displayError(error);
      }
    },
    cleanOtherPrimary(address) {
      if (address.is_primary) {
        var filter = address.is_billing ? "is_billing" : "is_shipping";
        var addresses = this.filterAddresses(filter);

        addresses.forEach(a => {
          if (a.is_primary && a.id != address.id) {
            a.cleanPrimary();
          }
        });
      }
    },
    displayError(error) {
      this.$swal({
        type: "error",
        text:
          "No se pudo completar la operación: " +
          JSON.stringify(error.message) +
          ". Por favor vuelve a intentarlo"
      });
    },
    displaySuccess(message) {
      this.$swal({
        type: "success",
        text: message
      });
    }
  },

  mounted() {
    this.getAddresses();
  }
};
</script>