<template>
  <div class>
    <div class="border-top mb-5"></div>

    <div v-if="userName && userName.length" class="mb-5">
      <div class="form-group mb-3">
        <div for="body" class="text-primary-transparency h5 mb-3">Déjanos un comentario</div>
        <div class="mb-3 text-sm text-blue-transparency">
          Estás conectado como
          <span class="text-primary">
            <u>{{ userName }}</u>
          </span>
        </div>
        <textarea
          class="form-control"
          name="body"
          id="body"
          rows="3"
          v-model="comment.body"
          placeholder="Comentario..."
        ></textarea>
      </div>
      <button
        class="btn btn-primary btn-block btn-sm font-weight-bold"
        @click="createComment"
        :disabled="!comment || !comment.body"
      >Publicar comentario</button>
    </div>
    <div class="h2 text-primary">Comentarios</div>
    <div class="w-100">
      <div v-for="(post_comment, index) in post_comments" :key="index" class="my-4 d-flex">
        <div class>
          <div v-if="post_comment.user" class="img-usr-testimonial avatar-md mx-auto my-2">
            <img class="img-fluid rounded-circle" :src="post_comment.user.avatar_image" />
          </div>
        </div>
        <div class="p-3">
          <div>
            <div v-if="post_comment.user" class="title my-2">
              <div href="#" class="text-dark-blue font-weight-bold">{{post_comment.user.full_name}}</div>
              <p class="mb-0">
                <img :src="baseUrl + '/images/logos/gradient-line-small.png'" class="mx-1" />
              </p>
            </div>
          </div>
          <div class="text-dark-blue">{{post_comment.body}}</div>

          <div v-if="!post_comments || !post_comments.length">
            <p>No se han encontrado comentarios</p>
          </div>
          <!-- price-wrap.// -->
        </div>
      </div>


      <div v-if="!loading && (!post_comments || !post_comments.length)">
        <p>No se han encontrado comentarios</p>
      </div>

      <button
        v-if="showMoreBtn && !loading"
        class="btn btn-primary-transparency font-weight-bold btn-block mt-5"
        @click="showMore"
      >Ver más comentarios</button>

      <div class="" v-if="loading">Cargando...</div>
    </div>
  </div>
</template>

<script>
import PostComment from "../../models/PostComment";

export default {
  props: {
    postId: null,
    userName: null
  },
  data() {
    return {
      post_comments: [],
      baseUrl: process.env.MIX_APP_URL,
      apiUrl: process.env.MIX_API_URL,
      page: 1,
      showMoreBtn: true,
      comment: new PostComment({
        post_id: null,
        body: ""
      }),
      loading: false,
      limit: 5
    };
  },
  methods: {
    async getComments() {
      this.loading = true;
      let response = await PostComment.page(this.page)
        .where("post_id", this.postId)
        .include("post", "user")
        .orderBy("-created_at")
        .limit(this.limit)
        .get();

      let post_comments = response.data

      if(response.last_page == this.page) {
        this.showMoreBtn = false
      }

      if (this.page != 1) {
        this.post_comments = [...this.post_comments, ...post_comments];
      } else {
        this.post_comments = post_comments;
      }

      this.loading = false;
    },
    async createComment() {
      try {
        let comment = await this.comment.save();
        this.comment.body = "";

        this.page = 1;
        this.getComments();
        this.$root.displaySuccess("Se ha publicado tu comentario");
      } catch (error) {
        console.error(error);
        this.$root.displayError(
          "No se pudo guardar tu comentario, por favor intenta de nuevo"
        );
      }
    },
    showMore() {
      this.page++;
      this.getComments();
    }
  },
  mounted() {
    this.comment.post_id = this.postId;
    this.getComments();
  }
};
</script>
