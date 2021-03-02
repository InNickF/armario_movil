<template>
  <div class>
    <div
      v-if="$parent.cart.count != undefined && $parent.cart.count <= 0"
      class="h-100 text-center my-4 py-4"
    >
      <div class="text-primary">No tienes productos en el carrito de compras.</div>
      <a :href="baseUrl + '/'" class="btn btn-sm btn-outline-primary mt-3">Volver a la tienda</a>
    </div>

    <div v-else>
      <h1 class="text-primary my-4">Carrito de compras</h1>
      <div class="row cont-cart">
        <div class="col-12 col-md-12 col-lg-8 mx-auto">
          <!-- Step 1 show cart items -->
          <cart v-if="step == 1"></cart>

          <!-- <div class="mt-3 h4 text-primary">¿No encuentras tus productos?</div>
          <div class="h6 text-primary">Descuida, están en
            <a :href="baseUrl + 'account/wishlist'">
            tu Whishlist</a>
          .</div>-->

          <!-- Step 2 select address -->
          <select-checkout-shipping-address
            :selected-addresses="selectedAddresses"
            @on-select-address="selectAddress"
            @on-select-global-address="selectGlobalAddress"
            @on-delete-address="deleteAddress"
            filter="is_paying"
            v-if="step == 2"
          ></select-checkout-shipping-address>
        </div>
        <div v-if="step<3" class="col-12 col-md-8 col-lg-4 mx-auto">
          <div class="card no-border bg-light">
            <div class="card-body">
              <h3 class="text-primary mb-3">Resumen de compra</h3>

              <div class="d-flex justify-content-between">
                <div>
                  <h5 class="mb-0 text-primary">
                    Subtotal
                    <span>
                      <small>(Incluído IVA)</small>
                    </span>:
                  </h5>
                  <p class="resumen-items">{{$parent.cart.count}} ítems</p>
                </div>
                <span class="h4 text-primary">${{ $parent.cart.subtotal }}</span>
              </div>

              <div
                class="d-flex justify-content-between mb-4"
                v-for="(condition, index) in $parent.cart.conditions"
                :key="index"
              >
                <div>
                  <h5 class="mb-0 text-primary">{{ condition.attributes.name }}</h5>
                  <div v-if="condition.type == 'coupon'">
                    <h5 class="mb-0 mb-0 text-pink-2">Cupón de descuento</h5>
                    <h5 class="mb-0 mb-0 text-pink-2 text-sm h5">{{condition.name}}</h5>
                  </div>

                  <div v-else>
                    <h5 class="mb-0 mb-0 text-primary h5">{{condition.name}}</h5>
                    <small>{{condition.attributes.description}}</small>
                    <h5 v-if="condition.type == 'local_shipping'" class="mb-0">
                      <!-- TODO: GLOVO LOGO -->
                      <img
                        :src="baseUrl + '/images/logos/glovo-logo.png'"
                        alt="..."
                        class="icon-sm-2"
                      />
                    </h5>
                    <h5
                      v-if="condition.type == 'national_shipping' || condition.type == 'galapagos_shipping'"
                      class="mb-0"
                    >
                      <img
                        :src="baseUrl + '/images/logos/urbano-logo.png'"
                        alt="..."
                        class="icon-sm-2"
                      />
                    </h5>
                  </div>
                </div>

                <span class="text-primary h4">
                  <span v-if="condition.type == 'coupon'">-</span>
                  ${{condition.calculated_value}}
                </span>
              </div>

              <div class="row px-0 mx-0 mt-4">
                <div class="col-md-8 px-0 mb-3 mb-md-0">
                  <input
                    type="text"
                    class="form-control form-control-transparent text-sm max-height-sm"
                    placeholder="Agrega aquí tu cupón"
                    v-model="couponCode"
                  />
                </div>
                <div class="col-md-4 pr-0 pl-0 pl-md-2">
                  <button
                    @click="$emit('apply-coupon', couponCode)"
                    class="btn btn-strong-pink-2 btn-sm btn-block"
                    :disabled="!couponCode.length"
                  >Aplicar</button>
                </div>
              </div>

              <div class="d-flex justify-content-between mt-5 resumen-total">
                <div class>
                  <h3 class="mb-0">
                    <strong>Total</strong>
                  </h3>
                </div>
                <h3>
                  <strong>${{ $parent.cart.total }}</strong>
                </h3>
              </div>

              <div v-if="isLoggedIn && hasCompleteProfile" class="text-center mt-3">
                <button
                  v-if="step == 1"
                  :disabled="!canContinue"
                  @click="step++"
                  class="btn btn-strong-pink-2 btn-block my-1"
                >Comprar ahora</button>

                <div class="mt-3" v-else>
                  <div
                    v-if="!canContinue && validationMessage.length"
                    class="alert alert-warning"
                    role="alert"
                  >
                    <span class="text-warging">*{{validationMessage}}</span>
                  </div>

                  <button
                    v-if="step == 2"
                    @click="doPayment"
                    class="btn btn-strong-pink-2 btn-block my-1"
                    :disabled="!canContinue || loading"
                  >{{loading ? 'Procesando...' : 'Proceder al pago'}}</button>
                </div>

                <button
                  v-if="step > 1 && step < 3 && !loading"
                  @click="step--"
                  class="btn my-1"
                >Regresar</button>
              </div>

              <div class="mt-3" v-if="isLoggedIn && !hasCompleteProfile">
                <button
                  @click="showProfileModal"
                  class="btn btn-lg btn-primary btn-block"
                >Comprar ahora</button>
              </div>

              <div class="mt-3" v-if="!isLoggedIn">
                <a :href="loginUrl" class="btn btn-lg btn-primary btn-block">Comprar ahora</a>
              </div>

              <div class="d-flex flex-wrap justify-content-center align-items-center mt-3">
                <a href="#" class="mx-3">
                  <img :src="baseUrl + '/images/logos/visa-logo.png'" alt="..." class />
                </a>
                <a href="#" class="mx-3">
                  <img :src="baseUrl + '/images/logos/mastercard-logo.png'" alt="..." class />
                </a>
              </div>
              <p class="text-center">Tarjetas de crédito, débito y prepago</p>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="text-center" v-if="step == 4">
        <h1>El pago ha sido realizado exitosamente</h1>
        <a class="btn btn-primary" :href="baseUrl + '/account/orders'">Ir a mis pedidos</a>
        <a class="btn btn-primary" :href="baseUrl + '/'">Seguir comprando</a>
      </div>-->
    </div>
  </div>
</template>


<script>
import Order from "../../models/Order";

export default {
  async mounted() {
    if (this.continueToStep == 2) {
      this.step = 2;
    }

    if (this.isLoggedIn && !this.hasCompleteProfile) {
      this.showProfileModal();
    }
  },
  props: {
    isLoggedIn: Boolean,
    hasCompleteProfile: Boolean,
    continueToStep: null
  },
  data() {
    return {
      order: Order,
      baseUrl: process.env.MIX_APP_URL,
      step: 1,
      selectedAddresses: {
        is_billing: null,
        is_shipping: null
      },
      couponCode: "",
      validationMessage: "",
      loading: false
    };
  },
  methods: {
    selectAddress(address, type) {
      this.selectedAddresses[type] = address;
      if (address) {
        this.calculateShipping(address);
      }
    },
    selectGlobalAddress(address, type) {
      this.selectedAddresses["is_billing"] = address;
      this.selectedAddresses["is_shipping"] = address;
      this.calculateShipping(address);
    },
    deleteAddress(address, type) {
      if (
        this.selectedAddresses[type] != undefined &&
        this.selectedAddresses[type].length
      ) {
        this.selectedAddresses[type] = null;
        // this.calculateShipping(address);
      }
    },
    calculateShipping(address) {
      this.$emit("calculate-shipping-costs", address);
    },
    async doPayment() {
      this.loading = true;
      try {
        let order = new Order({
          // * Only send selected address, the rest will be calculated in backend
          shipping_address_id: this.selectedAddresses.is_shipping.id
        });
        let saved = await order.save();
        this.$parent.cart = [];
        window.location = this.baseUrl + "/pay/" + saved.id;
      } catch (error) {
        console.dir(error.response);
        this.displayError(error.response.data.message);
        this.loading = false;
      }
    },
    showProfileModal() {
      $("#completeProfileModal").modal();
    },
    displaySuccess(message) {
      this.$swal({
        type: "success",
        text: "Tu compra ha sido procesada exitosamente"
      });
    },
    displayError(message) {
      this.$swal({
        type: "error",
        text: "Hubo un error al procesar tu compra"
      });
    }
  },
  computed: {
    canContinue() {
      switch (this.step) {
        case 1:
          this.validationMessage = "";
          return this.$parent.cart.count > 0;
          break;
        case 2:
          this.validationMessage =
            "Selecciona la dirección envío para continuar";
          return (
            this.selectedAddresses != null &&
            // this.selectedAddresses.is_billing != null && // ! Billing not required in cart anymore
            this.selectedAddresses.is_shipping != null
          );
          break;

        default:
          this.validationMessage = "";
          return true;
          break;
      }
    },
    loginUrl() {
      return this.baseUrl + "/login?from=checkout&temp=" + localStorage.userId;
    }
  }
};
</script>
