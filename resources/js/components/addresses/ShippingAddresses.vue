<template>
  <div>
    <div
      v-for="address in addresses"
      class="card rounded border-light-blue bg-light mb-3"
      :class="{'border-light-blue': address.is_primary}"
      :key="address.id"
    >
      <div class="card-body py-2">
        <div class="text-left">
          <h4 class="text-primary font-weight-bold mb-0 mt-1">
            {{ address.street }}
            <small
              v-if="address.is_primary"
              class="text-primary text-sm"
            >Dirección de envío principal</small>
          </h4>
          <div class="text-sm text-primary mb-3">{{ address.label }}</div>
          <!-- <div v-if="isSelectedAddress(address.id)" class="text-success">
          <i class="fa fa-check text-lg"></i>
          <span class="h3">Dirección seleccionada</span>
          </div>-->

          <div class :class="{'': isSelectedAddress(address.id) && !addressIsBeingEdited(address)}">
            <div
              v-if="isSelectedAddress(address.id)"
              class="d-flex justify-content-center align-items-between"
            >
              <div class="col-6 pl-0">
                <button class="pt-2 btn-block btn-primary-gradient btn-sm rounded-lg">Seleccionado</button>
              </div>
              <div class="mb-0 col-6">
                <button
                  v-if="!addressIsBeingEdited(address)"
                  @click.prevent="editAddress(address)"
                  class="btn-block btn btn-outline-primary btn-sm bg-transparent"
                >Editar</button>
              </div>
            </div>

            <div>
              <div
                v-if="!addressIsBeingEdited(address) && !isSelectedAddress(address.id)"
                class="d-flex justify-content-center align-items-between"
              >
                <div
                  v-if="showSelectButton"
                  @click.prevent="selectAddress(address)"
                  class="col-6 pl-0"
                >
                  <button
                    class="btn-block btn btn-sm btn-outline-primary bg-transparent"
                  >Seleccionar</button>
                </div>
                <p class="mb-0 col-6">
                  <button
                    v-if="!addressIsBeingEdited(address)"
                    @click.prevent="editAddress(address)"
                    class="btn-block btn btn-outline-primary btn-sm bg-transparent"
                  >Editar</button>
                </p>
              </div>
            </div>
            <!-- <div class="form-group pl-0 mt-2 mb-0">
              <div class="d-flex align-items-center">
                <div class="form-check abc-checkbox abc-checkbox-primary pl-0">
                  <input type="checkbox" class="form-check-input radio-custom checkbox" name="is_primary"
                    v-model="address.is_primary" />
                  <label class="form-check-label text-primary radio-custom-label" for="is_primary"
                    id="is_primary"></label>
                </div>
                <div class="text-primary text-sm pt-1 ml-2 font-weight-bold">Marcar como dirección de envío principal
                </div>

              </div>
            </div>-->
          </div>
        </div>

        <!-- <button
          v-if="!addressIsBeingEdited(address) && !isSelectedAddress(address.id)"
          @click.prevent="selectAddress(address)"
          class="btn btn-primary btn-sm"
        >Seleccionar</button>-->

        <!-- <button
          v-if="!addressIsBeingEdited(address)"
          @click.prevent="editAddress(address)"
          class="btn btn-secondary btn-sm"
        >Editar</button>-->
        <shipping-fields
          v-if="addressIsBeingEdited(address)"
          :address="address"
          :show-map="showMap"
          :states="states"
          @on-validate="onValidate"
          @on-change-position="onMovePosition"
        ></shipping-fields>
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
          >
            Eliminar
            dirección
          </button>
          <button
            type="submit"
            class="btn text-primary btn-link ml-2"
            @click.prevent="addressBeingEditedId = null"
          >Cancelar</button>
        </div>
      </div>
    </div>

    <button
      class="mt-3 btn btn-outline-primary btn-sm font-weight-bold pull-right btn-sm"
      @click.prevent="addAddress"
      v-bind:class="{'d-none' : !hideForm }"
    >Agergar una nueva dirección</button>

    <div
      class="card no-border bg-light rounded mb-5"
      v-bind:class="{'d-none' : hideForm }"
      v-if="newAddress"
    >
      <div class="card-body">
        <shipping-fields
          :address="newAddress"
          :show-map="showMap"
          :states="states"
          @on-validate="onValidate"
          @on-change-position="onMovePosition"
        ></shipping-fields>
        <div class="form-group col-sm-12 d-flex">
          <div class="col-6">
            <button
              :disabled="!newAddress.valid"
              type="submit"
              class="btn btn-primary btn-sm btn-block"
              @click.prevent="storeAddress"
            >Guardar</button>
          </div>
          <div class="col-6">
            <button
              class="btn btn-outline-transparent ml-2 btn-sm btn-block"
              @click.prevent="hideForm = true"
            >Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Address from "../../models/Address";

export default {
  props: {
    addresses: Array,
    selectedAddress: null,
    states: null,
    showSelectButton: {
      type: Boolean,
      default: true
    }
  },
  /*
   * The component's data.
   */
  data() {
    return {
      hideForm: true,
      newAddress: null,
      addressBeingEditedId: Number,
      baseUrl: process.env.MIX_APP_URL,
      showMap: true,
      filteredAddresses: []
    };
  },

  methods: {
    selectAddress(address) {
      this.$emit("on-select-address", address, "is_shipping");
    },
    selectGlobalAddress(address) {
      this.$emit("on-select-global-address", address, "is_shipping");
    },
    deleteAddress(address) {
      this.$emit("delete", address, "is_shipping");
    },
    isSelectedAddress(id) {
      if (this.selectedAddress == null) {
        return false;
      }
      return this.selectedAddress.id == id;
    },
    editAddress(address) {
      this.addressBeingEditedId = address.id;
    },
    addressIsBeingEdited(address) {
      return address.id == this.addressBeingEditedId;
    },
    addAddress() {
      this.newAddress = new Address({
        latitude: null,
        longitude: null
      });

      this.newAddress["is_shipping"] = true;

      this.hideForm = false;
    },
    storeAddress() {
      this.$emit("store", this.newAddress, "is_shipping");
      this.addAddress();
      this.hideForm = true;
    },
    saveAddress(address) {
      this.addressBeingEditedId = null;
      this.$emit("update", address);
    },

    onValidate(address, valid) {
      // var exists = this.addresses.find(a => a.id == address.id);

      if (address.id != undefined) {
        this.addresses.forEach((a, i) => {
          if (a.id == address.id) {
            Vue.set(this.addresses[i], "valid", valid);
            // Vue.set(this.addresses, a.id, valid)
            // a.valid = valid;
          }
        });
      } else {
        Vue.set(this.newAddress, "valid", valid);
        // this.newAddress.valid = valid;
      }
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
    }
  },

  mounted() {
    this.addAddress();

    if (this.addresses.length) {
      this.hideForm = true;
    }

    // if("is_shipping" == 'is_shipping') {
    //   this.showMap = true;
    // }
  }
};
</script>
