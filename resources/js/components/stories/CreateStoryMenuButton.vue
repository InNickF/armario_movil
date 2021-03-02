<template>
  <div>
    <div class="dropdown-item py-2 cursor-pointer text-decoration-none" @click="showModal">
      <img class="mr-2 fa-fw" :src="baseUrl+'/images/icons/profile-menu/24-hour-icon.svg'">
      <span class="text-primary">Subir oferta 24 horas</span>
    </div>

    
  </div>
</template>


<script>
export default {
  methods: {
    showModal() {
      this.$root.showModal("createStoryModal");
    },
    hideModal() {
      this.$root.hideModal("createStoryModal");
    }
  },
  data() {
    return {
      title: "",
      url: "",
      image: null,
      baseUrl: process.env.MIX_APP_URL
    };
  },
  mounted() {
  }
};
</script>