<template>
  <div>
    <li
      class="nav-item dropdown no-arrow mx-1 mob-fixed--icon mob-fixed--container-icon__notification"
    >
      <a
        class="nav-link dropdown-toggle py-1"
        href="#"
        id="messagesDropdown"
        data-toggle="dropdown"
        title="Mis notificaciones"
      >
        <!-- <i class="fas fa-bell fa-fw"></i> -->
        <img
          class="mob-fixed--notificacion-icon__notification small-icon-size"
          :src="'/images/icons/top-menu/notification-bell-icon-blue.svg'"
          alt
        />
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">{{badgeNumber}}</span>
      </a>
      <!-- Dropdown - Messages -->
      <div
        class="dropdown-list dropdown-menu dropdown-menu-right shadow"
        aria-labelledby="messagesDropdown"
      >
        <form>
          <h6 class="dropdown-header">Notificaciones</h6>
          <div
            class="d-flex flex-column align-items-center notifications-container"
            v-if="notifications"
          >
            <a
              v-for="(notification, index) in notifications"
              :key="index"
              class="dropdown-item d-flex align-items-center min-height-68"
              :class="[ notification.read_at == null ? 'bg-light' : '']"
              :href="notification.data.url"
              @click="markAsRead(notification)"
            >
              <div class="dropdown-list-image mr-3">
                <div
                  class="img-60px bg-cover rounded-circle mh-100"
                  :style="{backgroundImage: 'url('+notification.data.image_url+')'}"
                ></div>
                <div class="status-indicator bg-success"></div>
              </div>
              <div class="font-weight-bold">
                <div class="text-truncate">
                  <strong>{{notification.data.title}}</strong>
                </div>
                <div class="small text-gray-500">{{notification.data.body}}</div>
              </div>
            </a>
          </div>
          <button
            v-if="showMoreButton"
            class="dropdown-item text-center small text-gray-500"
            @click.prevent="getMore"
          >Ver más...</button>
          <p class="dropdown-item text-center small text-gray-500" v-else>No hay más notificaciones</p>
        </form>
      </div>
    </li>
  </div>
</template>

<script>
export default {
  props: {},
  data() {
    return {
      notifications: [],
      apiUrl: process.env.MIX_API_URL,
      page: 1,
      showMoreButton: true,
      badgeNumber: 0
    };
  },
  methods: {
    async getNotifications() {
      try {
        var response = await axios.get(
          this.apiUrl + "/notifications?page=" + this.page
        );
        let lastPage = response.data.data.notifications.last_page;
        let currentPage = response.data.data.notifications.current_page;

        let total = response.data.data.notifications.total;
        let totalUnread = response.data.data.total;
        let serverResponseNotifications = Array.from(
          response.data.data.notifications.data
        );

        if (totalUnread > 10) {
          // If there are more than 10 results, show the plus
          this.badgeNumber = "10+";
        } else {
          this.badgeNumber = totalUnread;
        }
        if (
          !serverResponseNotifications ||
          !serverResponseNotifications.length
        ) {
          this.showMoreButton = false;
          return;
        }
        this.notifications = [
          ...this.notifications,
          ...serverResponseNotifications
        ];

        if (lastPage <= currentPage) {
          this.showMoreButton = false;
        }
      } catch (error) {
        console.error(error);
        this.$root.displayError(
          error.response ? error.response.data.message : error
        );
      }
    },
    async markAsRead(notification) {
      try {
        var response = await axios.post(
          this.apiUrl + "/notifications/" + notification.id
        );
        let total = response.data.data.total;

        if (total > 10) {
          // If there are more than 10 results, show the plus
          this.badgeNumber = "10+";
        } else {
          this.badgeNumber = total;
        }

        notification.read_at = new Date();
      } catch (error) {
        console.error(error);
        // this.$root.displayError(
        //   error.response ? error.response.data.message : error
        // );
      }
    },
    getMore() {
      this.page++;
      this.getNotifications();
    }
  },
  mounted() {
    this.getNotifications();
  }
};
</script>