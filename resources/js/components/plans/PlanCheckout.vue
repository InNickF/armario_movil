<template>
  <div class="row mt-4">
    <div class="col-lg-12 col-md-12">
      <div class="mb-4 text-left text-primary h3">
        <div>Selecciona tus datos de pago</div>
      </div>
      <div v-if="cards && cards.length">
        <div
          class="card bg-gradient border-none p-2px my-2"
          v-for="(card, index) in getCardsOptions"
          :key="index"
        >
          <div class="card o-hidden border-none">
            <div class="card-body py-0">
              <div class="d-flex bd-highlight align-items-center">
                <div class="bd-highlight mr-4">
                  <img v-if="card.type=='vi'" :src="'/images/logos/visa-logo.png'" alt class />
                  <img
                    v-if="card.type=='mc'"
                    alt
                    :src="'/images/logos/mastercard-logo.png'"
                    class="px-3"
                  />
                </div>
                <div class="bd-highlight">
                  <h5 class="mb-0 text-primary">{{card.label}}</h5>
                  <div>
                    <div
                      @click.prevent="deleteCard(card.value)"
                      class="text-danger cursor-pointer text-sm"
                    >Borrar</div>
                  </div>
                </div>
                <div class="ml-auto bd-highlight">
                  <div
                    class="d-flex justify-content-center align-items-center card-bg"
                    :class="{'bg-gradient': selectedCard == card.value}"
                  >
                    <div v-if="isSelect">
                      <div
                        v-if="selectedCard != card.value"
                        @click="selectCardToken(card.value)"
                        class="cursor-pointer"
                      >
                        <div class="p-5">
                          <i class="fa fa-check text-lg text-light-blue"></i>
                        </div>
                      </div>
                      <div v-else>
                        <div class="p-5">
                          <i class="fa fa-check text-lg text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" v-model="selectedCard" name="token" />
      <div class="mt-4 text-left">
        <div
          @click.prevent="openAddCardModal"
          class="btn btn-outline-primary btn-sm"
        >Agregar una nueva tarjeta</div>
      </div>
    </div>

    <div v-if="isSelect" class="col-12">
      <div class="text-center mt-4 mb-3">
        <button
          :disabled="!selectedCard"
          type="submit"
          class="btn btn-strong-pink-2 btn-block my-1"
        >Pagar</button>
      </div>
    </div>
  </div>
</template>


<script>
import Product from "../../models/Product";

export default {
  props: {
    product: Product,
    isSelect: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      plans: null,
      baseUrl: process.env.MIX_API_URL,
      selectedPlan: null,
      cards: null,
      selectedCard: null,
      newCard: {}
    };
  },
  methods: {
    async getProductPlans() {
      var url = this.baseUrl + "/product_plans";

      try {
        var response = await axios.get(url);
        this.plans = response.data.data;
      } catch (error) {
        this.plans = [];
      }
    },
    async getUserCards() {
      var url = this.baseUrl + "/cards";

      try {
        var response = await axios.get(url);
        this.cards = response.data;

        if(this.cards.length && this.cards[0].token) {
          this.selectCardToken(this.cards[0].token)
        }
      } catch (error) {
        this.cards = [];
      }
    },
    async addCard() {
      var url = this.baseUrl + "/add_card";

      try {
        var response = await axios.post(url, this.newCard);
        this.displaySuccess("Se ha añadido esta tarjeta a tu perfil");
        this.getUserCards();
        this.newCard = {};
      } catch (error) {
        this.displayError(error.response.data);
      }
    },
    async deleteCard(token) {
      var url = this.baseUrl + "/remove_card";

      try {
        var response = await axios.post(url, {
          token: token
        });
        this.displaySuccess("Se ha borrado esta tarjeta de tu perfil");
        this.selectedCard = null;
        this.getUserCards();
      } catch (error) {
        this.displayError(error);
      }
    },
    async doPayment() {
      var data = {
        product_id: this.product.id,
        plan_id: this.selectedPlan.id,
        card_token: this.selectedCard
      };
      var url = this.baseUrl + "/orders/pay";

      try {
        var response = await axios.post(url, data);
        this.card = response.data;
        this.displaySuccess("Has realizado tu nueva suscripción con éxito");
        this.$emit("on-changed-plan");
      } catch (error) {
        this.displayError(error.response.data);
      }
    },
    selectCardToken(value) {
      this.selectedCard = value;
    },
    displayError(error) {
      this.$swal({
        type: "error",
        text: "Ha ocurrido un error al realizar tu nueva suscripción"
      });
    },
    displaySuccess(message) {
      this.$swal({
        type: "success",
        text: message
      });
    },
    openAddCardModal() {
      $("#addCardModal").modal();
    }
  },
  mounted() {
    this.getProductPlans();
    this.getUserCards();
    this.newCard = {};

    // if(this.isSelect == null) {
    //   this.isSelect = true
    // }
  },
  computed: {
    isValid() {
      var valid = true;
      Object.keys(this.fields).forEach(field => {
        if (!this.fields[field].valid) {
          valid = false;
          console.error(
            "Invalid product a field is not valid: " + JSON.stringify(field)
          );
        }
      });

      return valid;
    },
    getCardsOptions() {
      return this.cards.map(card => {
        return {
          label: card.holder_name + " - " + card.bin,
          value: card.token,
          type: card.type
        };
      });
    }
    // hasSelectedAddress() {
    //   return this.$refs.billingSelect.selectedAddress !== null;
    // }
  }
};
</script>
