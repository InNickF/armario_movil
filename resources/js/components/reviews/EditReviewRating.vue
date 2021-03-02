<template>
<div>

  <div class="d-flex justify-content-left mb-3 mt-1 mx-1">
    <image-rating :src="bagImagePath" v-model="review.rating" :item-size="30" :show-rating="false"></image-rating>
    <input type="text" name="rating" v-model="review.rating" hidden>

  </div>
  <div class="w-100 mb-2">
    <textarea v-model="review.body" class="form-control text-sm" name="body" id="" cols="30" rows="3" placeholder="Escribe tu opinión..."></textarea>
  </div>

  <button @click="updateRating" class="btn btn-outline-primary d-flex justify-content-center btn-block mt-3 font-weight-bold">Guardar calificación</button>
</div>
</template>

<script>
export default {
  components: {},
  props: {
    initialReview: 0,
    orderItemId: null
  },

  data() {
    return {
      baseUrl: process.env.MIX_API_URL,
      review: {
        rating: 0,
        body: null
      },
      bagImagePath: process.env.MIX_APP_URL + '/images/rating/bag-1.png'
    };
  },

  methods: {
    async updateRating() {
      var url = this.baseUrl + "/reviews/" + this.review.id;

      try {
        // Creates or updates review in backend
        var response = await axios.post(url, {
          order_item_id: this.orderItemId,
          rating: this.review.rating,
          reviewable_type: 'OrderItem',
          body: this.review.body,
        });
        this.$root.displaySuccess(
          "Se ha actualizado tu calificación"
        );
      } catch (error) {
        console.log(error);
        this.$root.displayError(
          "Ha ocurrido un error al guardar la calificación"
        );
      }
    }
  },

  mounted() {
    if(this.initialReview) {
      this.review = this.initialReview
    }
  }
};
</script>
