<template>
  <div>
    <h2 class="mb-4 text-primary text-left">Direcciones de envío</h2>
    <div class="row" v-if="!loading">
      <div class="col-sm-12 mb-4">
        <shipping-addresses
          :addresses="filterAddresses('is_shipping')"
          type="is_shipping"
          @delete="deleteAddress"
          @update="updateAddress"
          @store="storeAddress"
          @on-select-address="selectAddress"
          @on-select-global-address="selectGlobalAddress"
          :selected-address="selectedAddresses.is_shipping"
          :states="states"
        ></shipping-addresses>
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
      globalType: null,
      states: {},
      apiUrl: process.env.MIX_API_URL,
      loading: true
    };
  },

  props: {
    filter: String,
    selectedAddresses: {}
  },

  computed: {},

  methods: {
    async getAddresses() {
      if (this.filter.length) {
        this.addresses = await Address.where(this.filter, true).get();
      } else {
        this.addresses = await Address.get();
        this.addresses = this.addresses.filter(address => address.is_shipping); // Filter only shipping
      }
      if (!this.addresses.length) {
        // If no addresses in profile dont do anything
        return;
      }

      // Select primary as default selected
      this.addresses.forEach(address => {
        if (address.is_primary == true) {
          // if (address.is_shipping == true) {
          this.selectAddress(address, "is_shipping");
          // }
          // ! Billing no needed anymore
          // if (address.is_billing == true) {
          //   this.selectAddress(address, "is_billing");
          // }
        }
      });

      // If no primary was selected, select first
      if (!this.selectedAddresses.is_shipping) {
        this.selectAddress(this.addresses[0], 'is_shipping');
      }
    },
    showList(type) {
      if (this.globalType != null) {
        if (this.globalType != type) {
          return false;
        }
      }

      return true;
    },
    async deleteAddress(address, type) {
      // POST /post
      try {
        this.$emit("on-delete-address", address, this.filter);
        let deleted = await address.delete();
        this.addresses = this.addresses.filter(
          existingAddress => existingAddress.id != address.id
        );

        // Unselect address if selcted was deleted
        if(this.selectedAddresses.is_shipping && this.selectedAddresses.is_shipping.id == address.id) {
          this.selectAddress(null, 'is_shipping')
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

        // Recalculate shipping address if selected was updated
        if(this.selectedAddresses.is_shipping && this.selectedAddresses.is_shipping.id == updated.id) {
          this.selectAddress(updated, 'is_shipping')
        }

        this.$root.displaySuccess("Dirección actualizada");
      } catch (error) {
        this.$root.displayError(error);
      }
    },

    async storeAddress(newAddress, type) {
      newAddress[type] = true;
      if (this.filter.length) {
        newAddress[this.filter] = true; // paying or collecting
      }

      // let address = new Address(newAddress);
      // POST /post
      try {
        let addressSaved = await newAddress.save();
        this.addresses.push(new Address(addressSaved));
        this.makePrimary(addressSaved);

        // Select the new address
        this.selectAddress(addressSaved, 'is_shipping')

        this.$root.displaySuccess("Dirección guardada");
      } catch (error) {
        this.$root.displayError(error);
      }
    },
    selectAddress(address, type) {
      this.$emit("on-select-address", address, type);
      this.globalType = null;
    },
    filterAddresses(filter) {
      return this.addresses.filter(address => address[filter] == true);
    },
    selectGlobalAddress(address, type) {
      // this.$emit("on-select-global-address", address, type);
      this.globalType = type;
      // if(type == 'is_billing') {
      //   this.$refs.shipping_list.addresses.push(address)
      // } else {
      //   this.$refs.billing_list.addresses.push(address)
      // }
      // this.selectedAddresses["is_billing"] = address;
      // this.selectedAddresses["is_shipping"] = address;

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
          if (address.is_shipping == otherAddress.is_shipping) {
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