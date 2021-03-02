<template>
  <div>
    <div v-for="address in addresses" class="card rounded border-light-blue bg-light mb-3"
      :class="{'border-light-blue': address.is_primary}" :key="address.id">
      <div class="card-body py-2">
        <div class="text-left">
          <h4 class="text-primary font-weight-bold mb-0 mt-1">
            {{address.street}}
            <small v-if="address.is_primary" class="text-primary text-sm">Predeterminada</small>
          </h4>
          <div class="text-sm text-primary mb-3">{{ address.label }}</div>
        </div>

        <div :class="{'': isSelectedAddress(address.id) && !addressIsBeingEdited(address)}">
          <div v-if="isSelectedAddress(address.id)" class="d-flex justify-content-start align-items-between">

            <div class="ml-0 col-6" v-if="showSelectButton">
              <button class="pt-2 btn-block btn-primary-gradient btn-sm rounded-lg">Seleccionado</button>
            </div>

            <div class="mb-0 col-6">
              <button v-if="!addressIsBeingEdited(address)" @click.prevent="editAddress(address)"
                class="btn-block btn btn-outline-primary btn-sm bg-transparent">Editar</button>
            </div>

          </div>

          <div v-if="!addressIsBeingEdited(address) && !isSelectedAddress(address.id)"
            @click.prevent="selectAddress(address)" class="d-flex justify-content-start align-items-between">
             <div class="ml-0 col-6" v-if="showSelectButton">
              <button class="btn-block btn btn-sm btn-outline-primary bg-transparent">Seleccionar</button>
            </div>
            <div class="col-6 mb-0">
              <button v-if="!addressIsBeingEdited(address)" @click.prevent="editAddress(address)"
                class="btn-block btn btn-outline-primary btn-sm bg-transparent">Editar</button>
            </div>
           
          </div>
        </div>

        <billing-fields v-if="addressIsBeingEdited(address)" :address="address" :show-map="showMap" :states="states"
          @on-validate="onValidate" @on-change-position="onMovePosition"></billing-fields>
        <!-- Submit Field -->
        <div v-if="addressIsBeingEdited(address)" class="form-group col-sm-12">
          <button type="submit" class="btn btn-primary btn-sm" @click.prevent="saveAddress(address)"
            :disabled="!address.valid">Guardar cambios</button>
          <button type="submit" class="btn text-danger btn-link ml-2" @click.prevent="deleteAddress(address)">
            Eliminar
            datos
          </button>
          <button type="submit" class="btn text-primary btn-link ml-2"
            @click.prevent="addressBeingEditedId = null">Cancelar</button>
        </div>
      </div>
    </div>

    <button class="my-3 btn btn-outline-primary btn-sm font-weight-bold pull-right btn-sm" @click.prevent="addAddress"
      v-bind:class="{'d-none' : !hideForm }">Agregar una nueva dirección</button>

    <div class="card no-border mb-5" v-bind:class="{'d-none' : hideForm }" v-if="newAddress">
      <div class="card-body">
        <billing-fields :address="newAddress" :show-map="showMap" :states="states" @on-validate="onValidate"
          @on-change-position="onMovePosition"></billing-fields>
        <div class="form-group col-sm-12 d-flex flex-wrap">
          <div class="col-12 col-md-6">
            <button :disabled="!newAddress.valid" type="submit" class="btn btn-primary btn-sm btn-block"
              @click.prevent="storeAddress">Crear</button>
          </div>
          <div class="col-12 col-md-6">
            <button class="btn btn-outline-transparent ml-0 ml-md-2 mt-3 mt-md-0 btn-sm btn-block"
              @click.prevent="hideForm = true">Cancelar</button>
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
        this.$emit("on-select-address", address, "is_billing");
      },
      selectGlobalAddress(address) {
        this.$emit("on-select-global-address", address, "is_billing");
      },
      deleteAddress(address) {
        this.$emit("delete", address, "is_billing");
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

        this.newAddress["is_billing"] = true;

        this.hideForm = false;
      },
      storeAddress() {
        this.$emit("store", this.newAddress, "is_billing");
        this.addAddress();
        this.hideForm = true;
      },
      saveAddress(address) {
        this.addressBeingEditedId = null;
        this.$emit("update", address);
      },

      onValidate(address, valid) {
        if (address.id != undefined) {
          this.addresses.forEach((a, i) => {
            if (a.id == address.id) {
              Vue.set(this.addresses[i], "valid", valid);
            }
          });
        } else {
          Vue.set(this.newAddress, "valid", valid);
        }
      },
      onMovePosition(address, lat, lng) {
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
    }
  };

</script>
