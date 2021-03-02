<template>
  <div>
    <div v-for="(question, index) in questions" :key="index">
      <div class="d-flex flex-wrap mt-5 align-items-center">
        <img :src="baseUrl + '/images/product-questions/question.png'" alt class="mr-2" />
        <p class="text-primary mb-0">{{question.body}}</p>
      </div>
      <div v-if="question.answers != undefined && question.answers.length">
        <div
          v-for="(answer, index) in question.answers"
          :key="index"
          class="d-flex flex-wrap mt-1 ml-5 align-items-center"
        >
          <img
            v-if="answer.user && answer.user.id == answer.question.user.id"
            :src="baseUrl + '/images/product-questions/answer.png'"
            alt
            class="mr-2 invert-x"
          />
          <img v-else :src="baseUrl + '/images/product-questions/answer.png'" alt class="mr-2" />

          <p class="mb-0">{{answer.body}}</p>
        </div>
      </div>
    </div>
    <button
      v-if="showMoreBtn()"
      class="btn text-dark underline mt-5"
      @click="showAll"
    >Ver todas las preguntas</button>
  </div>
</template>

<script>
import Question from "../../models/Question";
export default {
  props: {
    productId: null
  },
  data() {
    return {
      questions: [],
      baseUrl: process.env.MIX_APP_URL,
      defaultLimit: 5,
      limit: 5
    };
  },
  methods: {
    async getQuestions() {
      this.questions = await Question.page(1)
        .limit(this.limit)
        .where("product_id", this.productId)
        .include("answers", "product")
        .orderBy("-created_at")
        .$get();
    },
    showAll() {
      this.limit = 30;
      this.getQuestions();
    },
    showMoreBtn() {
      return (
        this.limit == this.defaultLimit &&
        this.questions != undefined &&
        this.questions.length == this.defaultLimit
      );
    }
  },
  mounted() {
    this.getQuestions();
  }
};
</script>
