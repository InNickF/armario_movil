<template>
  <div id="cont-planes-wizard" class="content">
    <div class>
      <div v-if="!selectedPlan">
        <div class="row">
          <div class="col-sm-12 text-center text-primary">
            <h1 class="mb-4">Tipo de anuncio</h1>
          </div>
        </div>
        <div class="row">
          <div v-for="(plan, index) in plans" :key="index" class="col-12 col-md-4 card-plan">
            <div :class="getPlanClasses(plan)">
              <div class="card-body">
                <div v-if="plan.name == 'Cool'">
                  <img src="/images/wizard/icon-bag.png" class="my-2 mx-auto d-block" />
                  <h2 class="got-bold text-uppercase text-center my-4">{{plan.name}}</h2>
                  <div class="text-primary text-center">
                    <p class="font-weight-bold">Gratis</p>
                    <p class="text-sm mb-2">Muy buena visualización</p>
                    <div class="d-flex justify-content-center mb-2">
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                    </div>
                    <p class="text-sm mb-2">8 días de duración</p>
                  </div>
                </div>

                <div v-if="plan.name == 'Fashion'">
                  <img src="/images/wizard/icon-bag.png" class="my-2 mx-auto d-block" />
                  <h2 class="got-bold text-uppercase text-center my-4">{{plan.name}}</h2>
                  <div class="text-primary text-center">
                    <p class="font-weight-bold">Pago único de ${{plan.price}}</p>
                    <p class="text-sm mb-2">Visualización máxima</p>
                    <div class="d-flex justify-content-center mb-2">
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                       <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                    </div>
                    <p class="text-sm mb-2">30 días de duración</p>
                    <p class="text-sm mb-2">Presencia página principal</p>
                    <p class="text-sm mb-2">Página principal de categoría</p>
                  </div>
                </div>

                <div v-if="plan.name == 'Chic'">
                  <img src="/images/wizard/icon-bag.png" class="my-2 mx-auto d-block" />
                  <h2 class="got-bold text-uppercase text-center my-4">{{plan.name}}</h2>
                  <div class="text-primary text-center">
                    <p class="font-weight-bold">Pago único de ${{plan.price}}</p>
                    <p class="text-sm mb-2">Visualización alta</p>
                    <div class="d-flex justify-content-center mb-2">
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                      <img
                        src="/images/icons/single-product/suscription-person-icon.svg"
                        class="img-xs mx-1"
                        alt
                      />
                    </div>
                    <p class="text-sm mb-2">30 días de duración</p>
                    <p class="text-sm mb-2">Presencia página principal</p>
                  </div>
                </div>

              </div>
              <div class="card-footer bg-transparent border-0">
                <div v-if="canUpgradePlan(plan)" class="text-center">
                  <a
                    class="btn btn-sm btn-primary text-white font-weight-bold"
                    @click="selectPlan(plan)"
                  >Seleccionar</a>
                </div>
                <div v-if="isActualPlan(plan)" class="text-center">
                  <p class="btn btn-sm bg-white text-primary font-weight-bold">Seleccionado</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="selectedPlan">
        <div class="row">
          <div class="col-sm-12 text-center text-primary">
            <h2>Datos de facturación</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Product from "../../../models/Product";

export default {
  props: {
    product: null
  },
  data() {
    return {
      plans: null,
      baseUrl: process.env.MIX_API_URL,
      selectedPlan: null,
      cards: null,
      selectedCard: null,
      newCard: null
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
    selectPlan(plan) {
      var url =
        process.env.MIX_APP_URL +
        "/account/products/" +
        this.product.id +
        "/pay/" +
        plan.id;
      window.location = url;
    },
    getPlanClasses(plan) {
      let css = "card mx-auto";

      if (plan.name == "Cool") {
        css += " mt-5";
      }

      if (plan.name == "Chic") {
        css += " mt-5";
      }

      if (plan.name == "Fashion") {
        css += " mt-5 mt-md-0";
      }

      return css;
    },
    canUpgradePlan(plan) {
      if (plan.sort_order == 1) {
        return false;
      }

      if (this.product.ad_type == null || (this.product.ad_type && this.product.ad_type.slug != plan.slug)) {
          return true;
      }

      return false;
    },
    isActualPlan(plan) {
      if (this.product.ad_type && this.product.ad_type.slug == plan.slug) {
        return true;
      }

      if (plan.sort_order == 1 && this.product.ad_type == null) {
        return true;
      }

      return false;
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
    this.newCard = {};
  }
};
</script>
