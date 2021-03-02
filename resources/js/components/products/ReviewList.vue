<template>
  <div>
    <div v-for="(review, index) in reviews" :key="index" class="my-4">
      <div class="text-bold mb-2 font-weight-bold text-primary">{{review.user.full_name}}</div>
      <div class="d-flex flex-wrap">
        <div v-for="(star, index) in review.rating" :key="index">
          <!-- <img :src="baseUrl + '/images/rating/bag-' + index + '.png'" class="mx-1" /> -->
           <img :src="baseUrl + '/images/rating/bag-' + star + '.png'" class="mx-1 icon-sm" />
        </div>
      </div>
      <p class="mt-2 text-primary">{{review.body}}</p>
    </div>

    <div v-if="!reviews || !reviews.length">
      <p>No se han encontrado reseñas</p>
    </div>

    <button
      v-if="showMoreBtn"
      class="btn text-sm text-primary underline mt-4 font-weight-bold"
      @click="showMore"
    >Ver todas las calificaciones</button>
  </div>
</template>

<script>
import Review from "../../models/Review";
export default {
  props: {
    productId: null
  },
  data() {
    return {
      reviews: [],
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      page: 1,
      showMoreBtn: true
    };
  },
  methods: {
    async getReviews() {
      try {
        let response = await axios.get(
          this.apiUrl + "/reviews/" + this.productId + '?page=' + this.page
        );
        response = response.data.data // real response object from server, contains pagination data
        
        this.reviews = [...this.reviews, ...response.data];

        if(response.current_page == response.last_page) {
          this.showMoreBtn = false;
        }
      } catch (error) {
        console.error(error);
      }
      // console.log("reviews", this.reviews);
    },
    showMore() {
      this.page++
      this.getReviews();
    },
  },
  mounted() {
    this.getReviews();
  }
};
</script>
