<template>
  <div class>
    <div>
      <div class>
        <div class v-if="cards && cards.length">
          <div
            class="card bg-gradient border-none p-2px my-2"
            v-for="(card, index) in getCardsOptions"
            :key="index"
          >
            <div class="card o-hidden border-none">
              <div class="card o-hidden border-none">
                <div class="card-body py-3">
                  <div class="d-flex align-items-center justify-content-start">
                    <div class="bd-highlight mr-4">
                      <img v-if="card.type=='vi'" :src="'/images/logos/visa-logo.png'" alt class />
                      <img
                        v-if="card.type=='mc'"
                        alt
                        :src="'/images/logos/mastercard-logo.png'"
                        class
                      />
                    </div>
                    <div class="mt-0">
                      <h5 class="mb-0 text-primary">{{card.label}}</h5>
                      <div
                        @click.prevent="deleteCard(card.value)"
                        class="text-danger cursor-pointer text-sm mr-3"
                      >Borrar</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" v-model="selectedCard" name="token" />
          </div>

          <!-- <div class="text-center my-2">
        <div @click.prevent="openAddCardModal" class="btn btn-primary btn-lg">Agregar una tarjeta</div>
          </div>-->
        </div>
        <div
          class="my-5 col-12 h-100 d-flex justify-content-center align-items-center bg-white"
          v-else
        >
          <p class="text-primary">No tienes ninguna tarjeta en tu perfil</p>
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
      baseUrl: process.env.MIX_API_URL,
      cards: null,
      selectedCard: null
    };
  },
  methods: {
    async getUserCards() {
      var url = this.baseUrl + "/cards";

      try {
        var response = await axios.get(url);
        this.cards = response.data;
      } catch (error) {
        this.cards = [];
      }
    },
    async deleteCard(token) {
      var url = this.baseUrl + "/remove_card";

      try {
        var response = await axios.post(url, {
          token: token
        });
        // this.displaySuccess("Se ha borrado esta tarjeta de tu perfil");
        this.selectedCard = null;
        this.getUserCards();
      } catch (error) {
        console.error(error);
        this.displayError(error);
      }
    },
    async selectAsPrimary(token) {
      var url = this.baseUrl + "/update_card";

      try {
        var response = await axios.post(url, {
          card_token: token,
          is_primary: true
        });
        this.displaySuccess("Se ha seleccionado esta tarjeta como principal");
        this.selectedCard = token;
        this.getUserCards();
      } catch (error) {
        console.error(error);
        this.displayError(error);
      }
    },
    // openAddCardModal() {
    //   // console.log("open add card modal...");
    //   $("#addCardModal").modal();
    // },
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
          is_primary: card.is_primary,
          type: card.type
        };
      });
    }
  }
};
</script>
