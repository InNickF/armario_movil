<template>
  <div>
    <div class="row mt-0 pt-4">
      <div class="col-3"></div>
      <div class="col-9 text-primary mt-5">
        Últimas calificaciones
        <div v-for="(review, index) in reviews" :key="index" class="my-4">
          <div v-if="review.user">
            <div class="d-flex">
              <div class="img-wrap mb-avatar-store">
                <img class="avatar-sm-md rounded-circle mr-3" :src="review.user.avatar_image" />
              </div>

              <div>
                <div class="text-bold">{{review.user.full_name}}</div>
                <div class="d-flex">
                  <div v-for="(star, index) in review.rating" :key="index">
                    <img
                      :src="baseUrl + '/images/rating/bag-' + star + '.png'"
                      alt
                      class="mx-1 rating-sm mt-0"
                    />
                  </div>
                </div>
                <p class="mt-2 text-light-grey">{{review.body}}</p>
              </div>
            </div>
          </div>
        </div>

        <button v-if="showMoreBtn()" class="btn text-dark underline mt-5" @click="showAll">
          Ver todas las
          calificaciones
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Review from "../../models/Review";
export default {
  props: {
    storeId: null
  },
  data() {
    return {
      reviews: [],
      baseUrl: process.env.MIX_APP_URL,
      defaultLimit: 5,
      limit: 5
    };
  },
  methods: {
    async getReviews() {
      this.reviews = await Review.page(1)
        .limit(this.limit)
        .where("store_id", this.storeId)
        .include("user")
        .orderBy("-created_at")
        .$get();
    },
    showAll() {
      this.limit = 30;
      this.getReviews();
    },
    showMoreBtn() {
      // console.log(this.limit, this.defaultLimit);
      return (
        this.limit == this.defaultLimit &&
        this.reviews != undefined &&
        this.reviews.length == this.defaultLimit
      );
    }
  },
  mounted() {
    this.getReviews();
  }
};
</script>
