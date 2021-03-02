<template>
  <div>
    <div class="card o-hidden border-0 shadow-lg mb-3">
      <div class="card-body py-2">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="d-flex align-items-center">
              <div v-if="collectingMethod.bank && collectingMethod.bank.logo" class="p-2">
                <img :src="collectingMethod.bank.logo" alt class="img-fluid img-sm" />
              </div>
              <div class>
                <p class="mb-0">
                  {{ collectingMethod.name }}
                  <small
                    v-if="collectingMethod.bank"
                  >({{collectingMethod.bank.name}})</small>
                </p>
                <div class="d-flex align-items-center">
                  <p class="mb-0 mr-3">{{collectingMethod.account_number}}</p>
                  <div
                    @click.prevent="deleteCollectingMethod(collectingMethod.id)"
                    class="text-danger cursor-pointer text-sm"
                  >Borrar</div>
                </div>
              </div>
            </div>
          </div>

          <div
            class="d-flex justify-content-center align-items-center card-bg"
            :class="{'bg-secondary': collectingMethod.is_primary}"
          >
            <div>
              <div
                v-if="!collectingMethod.is_primary"
                @click="selectAsPrimary(collectingMethod.id)"
                class="cursor-pointer"
              >
                <div class="p-5">
                  <i class="fa fa-check text-lg text-secondary"></i>
                </div>
              </div>
              <div v-else @click="removeAsPrimary(collectingMethod.id)">
                <div class="p-5">
                  <i class="fa fa-check text-lg text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="my-5 d-flex justify-content-center align-items-center" v-if="!collectingMethod">
      <p>No has guardado tu método de cobro</p>
    </div>
  </div>
</template>


<script>
export default {
  props: {},
  /*
   * The component's data.
   */
  data() {
    return {
      collectingMethod: null,
      baseUrl: process.env.MIX_API_URL
    };
  },

  methods: {
    async getUserCollectingMethod() {
      var url = this.baseUrl + "/collecting_method";

      try {
        var response = await axios.get(url);
        this.collectingMethod = response.data;
      } catch (error) {
        this.collectingMethod = [];
      }
    },
    async deleteCollectingMethod(key) {
      var url = this.baseUrl + "/remove_collecting_method/" + key;

      try {
        var response = await axios.post(url);
        this.displaySuccess(
          "Tu forma de cobro ha sido eliminada correctamente"
        );
        this.getUserCollectingMethod();
      } catch (error) {
        this.$root.displayError(
          "Ha ocurrido un error al eliminar tu forma de cobro"
        );
      }
    },
    async selectAsPrimary(key) {
      var url = this.baseUrl + "/update_collecting_method/" + key;

      try {
        var response = await axios.post(url, {
          is_primary: true
        });
        this.$root.displaySuccess("Se ha actualizado la cuenta");
        this.getUserCollectingMethod();
      } catch (error) {
        this.$root.displayError(
          "Ha ocurrido un error al actualizar tu forma de cobro"
        );
      }
    },
    async removeAsPrimary(key) {
      var url = this.baseUrl + "/update_collecting_method/" + key;

      try {
        var response = await axios.post(url, {
          is_primary: false
        });
        this.$root.displaySuccess("Se ha actualizado la cuenta");
        this.getUserCollectingMethod();
      } catch (error) {
        this.$root.displayError(
          "Ha ocurrido un error al actualizar tu forma de cobro"
        );
      }
    }
  },

  mounted() {
    // console.log("Component mounted.");
    // console.log(this.collectingMethod);
    this.getUserCollectingMethod();
  }
};
</script>