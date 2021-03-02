<template>
  <div class>
    <div>
      <div class v-if="cards && cards.length">
        <div class="card no-border bg-light" v-for="(card, index) in getCardsOptions" :key="index">
          <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <h5 class="mb-0">{{card.label}}</h5>
                <h5 class="mb-0">MARCA: {{card.type}}</h5>
                <div>
                  <div
                    @click.prevent="deleteCard(card.value)"
                    class="text-danger cursor-pointer text-sm"
                  >Borrar</div>
                </div>
              </div>

              <div
                class="d-flex justify-content-center align-items-center"
                :class="{'bg-secondary': selectedCard == card.value}"
              >
                <div v-if="isSelect">
                  <div
                    v-if="selectedCard != card.value"
                    @click="selectCardToken(card.value)"
                    class="cursor-pointer"
                  >
                    <div class="p-5">
                      <i class="fa fa-check text-lg text-secondary"></i>
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

        <input type="hidden" v-model="selectedCard" name="token" />
      </div>

      <div class="mt-5 mb-2 col-12 h-100 d-flex justify-content-center align-items-center" v-else>
        <p>No tienes ninguna tarjeta en tu perfil</p>
      </div>

      <div v-if="isSelect" class="col-12 pt-2">
        <div
          v-if="!selectedCard"
          class="alert alert-warning"
          role="alert"
        >Selecciona una tarjeta para continuar con el pago</div>
      </div>

      <div class="text-center mt-2">
        <div @click.prevent="openAddCardModal" class="btn btn-primary">Agregar una tarjeta</div>
      </div>
      <div class="text-center mt-4 mb-5">
        <button :disabled="!selectedCard" type="submit" class="btn btn-primary btn-lg">Pagar</button>
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
    },
    showButton: true
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
        var response = await axios.post(url, { token: token });
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
        this.displaySuccess(response.data);
        this.$emit("on-changed-plan");
      } catch (error) {
        this.displayError(error.response.data);
      }
    },
    selectCardToken(value) {
      this.selectedCard = value;
    },
    openAddCardModal() {
      $("#addCardModal").modal();
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
  }
};
</script>