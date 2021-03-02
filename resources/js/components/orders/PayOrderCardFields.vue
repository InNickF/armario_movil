<template>
  <div class="content mt-5">
    <div>
      <div class="row">
        <div class="col-12 text-center" v-if="cards && cards.length">
          <h4>Pagar con una tarjeta usada anteriormente</h4>

          <!-- <v-select
              v-model="selectedCard"
              :options="getCardsOptions"
              placeholder="Selecciona una de tus tarjetas..."
          ></v-select>-->

          <div class="card" v-for="(card, index) in getCardsOptions" :key="index">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4>{{card.label}} - {{card.value}}</h4>
                </div>
                <div>
                  <button
                    v-if="selectedCard != card.value"
                    @click="selectCardToken(card.value)"
                    class="btn btn-primary btn-sm"
                  >Seleccionar tarjeta</button>
                  <h3 v-else class="text-success">Tarjeta seleccionada</h3>
                  <button
                    @click="deleteCard(card.value)"
                    class="btn btn-danger btn-sm"
                  >Borrar tarjeta</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-12 my-3 p-4">
          <div class="card">
            <div class="card-body">
              <h4>Agregar una tarjeta nueva</h4>
              <div class="row mb-4">
                <div class="col-6 my-2">
                  <input
                    v-model="newCard.number"
                    class="card-number form-control"
                    placeholder="Número de tarjeta"
                    v-validate="'required|credit_card'"
                    name="number"
                  />
                  <p id="error" class="text-danger">{{ errors.first('number') }}</p>
                </div>

                <div class="col-6 my-2">
                  <input
                    v-model="newCard.holder_name"
                    class="name form-control"
                    placeholder="Nombre"
                    v-validate="'required'"
                    name="holder_name"
                  />
                  <p id="error" class="text-danger">{{ errors.first('holder_name') }}</p>
                </div>
                <div class="col-3 my-2">
                  <input
                    type="number"
                    v-model="newCard.expiry_month"
                    class="expiry-month form-control"
                    placeholder="Mes"
                    v-validate="'required'"
                    name="expiry_month"
                  />
                  <p id="error" class="text-danger">{{ errors.first('expiry_month') }}</p>
                </div>
                <div class="col-3 my-2">
                  <input
                    type="number"
                    v-model="newCard.expiry_year"
                    class="expiry-year form-control"
                    placeholder="Año"
                    v-validate="'required'"
                    name="expiry_year"
                  />
                  <p id="error" class="text-danger">{{ errors.first('expiry_year') }}</p>
                </div>
                <div class="col-6 my-2">
                  <input
                    v-model="newCard.cvc"
                    class="cvc form-control"
                    placeholder="Código"
                    v-validate="'required'"
                    name="cvc"
                  />
                  <p id="error" class="text-danger">{{ errors.first('cvc') }}</p>
                </div>
              </div>
              <div class="px-3 text-center">
                <button
                  :disabled="!isValid"
                  @click="addCard"
                  class="btn btn-primary"
                >Agregar tarjeta</button>
              </div>
              <br />
              <div class="text-center text-primary" id="messages"></div>
            </div>
          </div>

          <div class="text-center mt-4 mb-5">
            <button
              :disabled="!selectedCard"
              @click="doPayment"
              class="btn btn-primary btn-lg"
            >Pagar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Product from "../../models/Product";

export default {
  props: {
    product: Product
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
  computed: {
    getCardsOptions() {
      return this.cards.map(card => {
        return {
          label: card.holder_name + " - " + card.bin,
          value: card.token
        };
      });
    }
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
        this.displaySuccess("Se ha borrado esta tarjeta a tu perfil");
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
    }
  }
};
</script>