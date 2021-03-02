<template>
  <div>
    <!-- bottom-wrap.// -->
    <div class="row" v-if="product">
      <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="o-hidden border-0 my-4">
          <div class="card-body">
            <h5 class="text-primary font-weight-bold">¿Tienes alguna pregunta?</h5>
            <p class>
              Encuentra respuestas en la información del producto, en preguntas
              y respuestas y en reseñas.
            </p>
            <div v-if="userId != null && userId.length">
              <div v-if="!userQuestion" class="my-3">
                <div class="form-group">
                  <textarea
                    class="form-control"
                    v-model="questionBody"
                    placeholder="¿Tienes alguna pregunta?"
                  ></textarea>
                </div>
                <button
                  class="btn btn-sm btn-outline-primary font-weight-bold"
                  @click="askQuestion"
                  :hidden="!questionBody.length"
                >Enviar pregunta</button>
              </div>
            </div>
            <question-list :product-id="product.id" ref="questionList"></question-list>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="o-hidden border-0 my-4">
          <div class="card-body">
            <h5 class="text-primary mb-4 font-weight-bold">Últimas calificaciones</h5>
            <review-list :product-id="product.id" ref="reviewList"></review-list>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Product from "../../models/Product";

export default {
  components: {},
  props: {
    product: null,
    userId: null
  },

  data() {
    return {
      questionBody: "",
      question: "",
      userQuestion: "",
      baseUrl: process.env.MIX_APP_URL
    };
  },

  methods: {
    askQuestion() {
      axios
        .post(this.baseUrl + "/api/questions", {
          product_id: this.product.id,
          body: this.questionBody
        })
        .then(
          response => {
            this.question = response.data.data;
            this.$refs.questionList.getQuestions();
            this.userQuestion = this.question;
            this.$swal({
              type: "success",
              text: "Tu pregunta ha sido realizada correctamente"
            });

            this.$ga.event(
              "Producto",
              "Preguntas / Wishlist",
              this.product.name,
              this.product.id,
              {
                hitCallback: function() {}
              }
            );
          },
          error => {
            this.$swal({
              type: "error",
              text: "Ha ocurrido un error al realizar la pregunta"
            });
          }
        );
    }
  },

  mounted() {
    this.userQuestion;

    // if (this.oldReview) {
    //   this.review = this.oldReview;
    // }
  }
};
</script>
