import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex)
// const debug = process.env.NODE_ENV !== 'production'

const store = new Vuex.Store({
  // modules: {
  //   auth,
  //   snackbar,
  //   users
  // },
  // strict: debug,
  state: {
    loagindCart: false
  },
  getters: {
    loagindCart: state => state.loagindCart
  },
  mutations: {
    activateLoadingCart(state) {
      state.loagindCart = true
    },
    deactivateLoadingCart(state) {
      state.loagindCart = false
    }
  }
})

import withSnackbar from './components/mixins/withSnackbar'

import axios from 'axios'
import {
  Model
} from 'vue-api-query'

import Datetime from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'

import VueSweetalert2 from 'vue-sweetalert2'

import {
  StarRating
} from 'vue-rate-it';
import {
  ImageRating
} from 'vue-rate-it';


import * as VueGoogleMaps from 'vue2-google-maps'


import Editor from "@tinymce/tinymce-vue";
Vue.component('tinymce', Editor);



/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
window.Vue = require('vue')
window.Vuetify = require('vuetify')


Vue.use(Vuetify)

Vue.use(Datetime)
Vue.use(VueSweetalert2)

// inject global axios instance as http client to Model
Model.$http = axios

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)


Vue.use(VueGoogleMaps, {
  load: {
    key: process.env.MIX_GOOGLE_MAPS_API_KEY,
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)

    //// If you want to set the version, you can do so:
    // v: '3.26',
  },

  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  autobindAllEvents: true,

  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
})




import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)



import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);
import {
  ValidationProvider
} from 'vee-validate';
Vue.component('ValidationProvider', ValidationProvider);



//
// Register the whole module with vue
//
import VueMomentLib from "vue-moment-lib";

// Install this library
Vue.use(VueMomentLib);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('star-rating', StarRating);
Vue.component('image-rating', ImageRating);

Vue.component('edit-review-rating', require('./components/reviews/EditReviewRating.vue'));
// Vue.component('login-button', require('./components/LoginButtonComponent.vue'))
// Vue.component('register-button', require('./components/RegisterButtonComponent.vue'))
// Vue.component('remember-password', require('./components/RememberPasswordComponent.vue'))
// Vue.component('reset-password', require('./components/ResetPasswordComponent.vue'))
// Vue.component('snackbar', require('./components/SnackBarComponent.vue'))
// Vue.component('gravatar', require('./components/GravatarComponent.vue'))


Vue.component('shipping-fields', require('./components/addresses/ShippingFields.vue'))
Vue.component('billing-fields', require('./components/addresses/BillingFields.vue'))
Vue.component('profile-address-fields', require('./components/users/ProfileAddressFields.vue'))
Vue.component('update-addresses', require('./components/addresses/UpdateAddresses.vue'))
Vue.component('update-billing', require('./components/addresses/UpdateBilling.vue'))
Vue.component('select-checkout-shipping-address', require('./components/orders/SelectCheckoutShippingAddress.vue'))
Vue.component('select-checkout-billing-address', require('./components/orders/SelectCheckoutBillingAddress.vue'))
Vue.component('shipping-addresses', require('./components/addresses/ShippingAddresses.vue'))
Vue.component('billing-addresses', require('./components/addresses/BillingAddresses.vue'))
Vue.component('product-plan-select-billing', require('./components/products/ProductPlanSelectBilling.vue'))
Vue.component('product-plan-user-cards', require('./components/products/ProductPlanUserCards.vue'))
Vue.component('plan-checkout', require('./components/plans/PlanCheckout.vue'))
Vue.component('followed-categories', require('./components/users/FollowedCategories.vue'))


Vue.component('user-collecting-method-list', require('./components/payment-methods/UserCollectingMethodList.vue'))


Vue.component('update-notification-settings', require('./components/notification-settings/UpdateNotificationSettings.vue'))


Vue.component('nested-categories', require('./components/categories/NestedCategories.vue'))

Vue.component('product-wizard', require('./components/products/wizard/ProductWizard.vue'))
Vue.component('edit-product-form', require('./components/products/EditProductForm.vue'))
Vue.component('product-grid', require('./components/products/ProductGrid.vue'))
Vue.component('product-card', require('./components/products/ProductCard.vue'))
Vue.component('product-card-sm', require('./components/products/ProductCardSmall.vue'))
Vue.component('product-images', require('./components/products/ProductImages.vue'))
Vue.component('single-product', require('./components/products/SingleProduct.vue'))
Vue.component('wishlist-product', require('./components/products/WishlistProduct.vue'))
Vue.component('single-product-small', require('./components/products/SingleProductSmall.vue'))
Vue.component('product-detail-footer', require('./components/products/ProductDetailFooter.vue'))
Vue.component('color-select', require('./components/products/ColorSelect.vue'))
Vue.component('product-color-variant-media', require('./components/products/wizard/ProductColorVariantMedia.vue'))
Vue.component('single-product-carousel', require('./components/products/SingleProductCarousel.vue'))

Vue.component('outfit-card', require('./components/outfits/OutfitCard.vue'))
Vue.component('single-outfit', require('./components/outfits/SingleOutfit.vue'))
Vue.component('outfit-images', require('./components/outfits/OutfitImages.vue'))
Vue.component('add-outfit-to-cart-button', require('./components/checkout/AddOutfitToCartButton.vue'))
Vue.component('outfit-wizard', require('./components/outfits/wizard/OutfitWizard.vue'))
Vue.component('edit-outfit', require('./components/outfits/EditOutfit.vue'))
Vue.component('outfit-media', require('./components/outfits/wizard/OutfitMedia.vue'))


Vue.component('product-color-variants-tabs', require('./components/products/wizard/ProductColorVariantsTabs.vue'))
Vue.component('wizard-variant-tabs', require('./components/products/wizard/WizardVariantTabs.vue'))
Vue.component('product-plan-select', require('./components/products/wizard/ProductPlanSelect.vue'))
Vue.component('size-select', require('./components/products/SizeSelect.vue'))
Vue.component('wizard-size-select', require('./components/products/wizard/WizardSizeSelect.vue'))
Vue.component('wizard-example-size-select', require('./components/products/wizard/WizardExampleSizeSelect.vue'))
Vue.component('wizard-image-help-slider', require('./components/products/wizard/ImageHelpSlider.vue'))
Vue.component('wizard-video-help-slider', require('./components/products/wizard/VideoHelpSlider.vue'))
Vue.component('question-list', require('./components/products/QuestionList.vue'))
Vue.component('review-list', require('./components/products/ReviewList.vue'))

Vue.component('post-comment-list', require('./components/blog/PostCommentList.vue'))

Vue.component('store-review-list', require('./components/stores/StoreReviewList.vue'))
Vue.component('store-gallery', require('./components/stores/StoreGallery.vue'))
Vue.component('store-open-hours-form', require('./components/stores/StoreOpenHoursForm.vue'))

Vue.component('upload-single-media', require('./components/UploadSingleMedia.vue'))
Vue.component('upload-single-image', require('./components/UploadSingleImage.vue'))
Vue.component('upload-single-document', require('./components/UploadSingleDocument.vue'))
Vue.component('upload-product-single-image', require('./components/products/wizard/UploadProductSingleImage.vue'))
Vue.component('upload-single-image-button', require('./components/UploadSingleImageButton.vue'))
Vue.component('upload-multiple-images', require('./components/UploadMultipleImages.vue'))
Vue.component('upload-single-video', require('./components/UploadSingleVideo.vue'))
Vue.component('upload-product-single-video', require('./components/products/wizard/UploadProductSingleVideo.vue'))
Vue.component('date-selector', require('./components/DateSelector.vue'))

Vue.component('cart-icon', require('./components/checkout/CartIcon.vue'))
Vue.component('add-to-cart-button', require('./components/checkout/AddToCartButton.vue'))
Vue.component('cart', require('./components/checkout/Cart.vue'))
Vue.component('checkout', require('./components/checkout/Checkout.vue'))
Vue.component('toggle-button-input', require('./components/ToggleButtonInput.vue'))
Vue.component('glovo-tracking-map', require('./components/orders/GlovoTrackingMap.vue'))
Vue.component('store-profile-address-fields', require('./components/stores/StoreProfileAddressFields.vue'))

Vue.component('pay-order-card-fields', require('./components/orders/PayOrderCardFields.vue'))
Vue.component('user-cards', require('./components/orders/UserCards.vue'))

Vue.component('user-cards-list', require('./components/users/UserCardsList.vue'))
Vue.component('wishlist', require('./components/wishlist/Wishlist.vue'))
Vue.component('notifications-list', require('./components/notifications/NotificationsList.vue'))

Vue.component('text-editor', require('./components/TextEditor.vue'))

// * Admin components
Vue.component('slider-form', require('./components/admin/SliderForm.vue'))
Vue.component('footer-links-form', require('./components/admin/FooterLinksForm.vue'))

// Historias
Vue.component('create-story-menu-button', require('./components/stories/CreateStoryMenuButton.vue'))
Vue.component('create-story-carousel-button', require('./components/stories/CreateStoryCarouselButton.vue'))
Vue.component('create-story-form', require('./components/stories/CreateStoryForm.vue'))
Vue.component('stories-by-store-card', require('./components/stories/StoriesByStoreCard.vue'))
Vue.component('store-logo', require('./components/stores/StoreLogo.vue'))
Vue.component('stories-button', require('./components/stores/StoriesButton.vue'))
Vue.component('stories-carousel', require('./components/stories/StoriesCarousel.vue'))
Vue.component('stories-modal', require('./components/stories/StoriesModal.vue'))

// Sidebar
Vue.component('sidebar', require('./components/Sidebar.vue'))


Vue.component('select-input', require('./components/SelectInput.vue'))


import firebase from 'firebase/app';
import 'firebase/messaging';

var config = {
  messagingSenderId: process.env.MIX_FCM_SENDER_ID
};
firebase.initializeApp(config);




import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


// if (process.browser) {
import VueAwesomeSwiper from 'vue-awesome-swiper'
Vue.use(VueAwesomeSwiper, /* { default global options } */ )

import VueAnalytics from 'vue-analytics'

Vue.use(VueAnalytics, {
  id: 'UA-133444869-2',
  disableScriptLoader: true, // Because its already in head partial
  // debug: {
  //   enabled: true
  // }
})


const mime = require("mime");



import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'es', // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    // 'es-ES': require('date-fns/locale/es_es'),
    es: require('date-fns/locale/es')
  }
})


var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease",
  offset: 0,
  force: true,
  cancelable: true,
  onStart: false,
  onDone: false,
  onCancel: false,
  x: false,
  y: true
})

import InlineSvg from 'vue-inline-svg';
Vue.component('inline-svg', InlineSvg);

import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
Vue.use(VueSidebarMenu)



const app = new Vue({
  el: '#app',
  store,
  mixins: [withSnackbar],
  data: () => ({
    // drawer: null,
    // drawerRight: false,
    // editingUser: false,
    // logoutLoading: false,
    // changingPassword: false,
    // updatingUser: false,
    cart: [],
    user: null,
  }),
  computed: {
    // ...mapGetters({
    //   user: 'user'
    // })
  },
  methods: {
    async getCart() {
      var url = process.env.MIX_API_URL + "/cart"

      if (localStorage.userId) {
        url += '?userId=' + localStorage.userId
      }
      localStorage.removeItem('userId')

      try {
        var response = await axios.get(url);
        this.cart = response.data.data;

        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
      } catch (error) {
        this.cart = []
      }
    },
    async addProductToCart(params) {
      ga('send', 'event', 'Producto', 'Agregar al carrito', params.product.name, params.product.id, {
        // hitCallback: function () {
        //   console.log('ANALYTICS: click sent');;
        // }
      })
      if (params.variant.quantity < params.qty) {
        this.displayError('No se puede añadir esa cantidad, la cantidad disponible de este producto es de ' + params.variant.quantity)
        return
      }
      try {

        var paramsFinal = {
          product_id: params.product.id,
          variant_id: params.variant.id,
          quantity: params.qty,
          color: params.color,
          size: params.size,
        }
        if (localStorage.userId) {
          paramsFinal.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.post(process.env.MIX_API_URL + "/cart", paramsFinal)

        this.cart = response.data.data
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
        // this.displaySuccess("El producto ha sido agregado al carrito de compras")
        this.$root.displayToast({
          image_url: params.product.main_image_thumbnail,
          title: params.product.name,
          body: "El producto ha sido agregado al carrito de compras",
          link: process.env.MIX_APP_URL + "/checkout"
        });
      } catch (error) {
        this.displayError(error.response.data.message)
      }

    },
    async addOutfitToCart(params) {
      ga('send', 'event', 'Outfit', 'Agregar al carrito', params.outfit.name, params.outfit.id, {
        // hitCallback: function () {
        //   console.log('ANALYTICS: click sent');;
        // }
      })

      this.$store.commit('activateLoadingCart')


      try {

        for (let index = 0; index < params.variants.length; index++) {

          const v = params.variants[index];
          var postBody = {
            product_id: v.product_id,
            variant_id: v.id,
            quantity: params.qty,
            color: v.color,
            size: v.size,
          }
          if (localStorage.userId) {
            postBody.userId = localStorage.userId
          }
          localStorage.removeItem('userId')
          var response = await axios.post(process.env.MIX_API_URL + "/cart", postBody)
          this.cart = response.data.data
          if (this.cart.userId) {
            localStorage.userId = this.cart.userId
          }
        }
        // this.displaySuccess("Los productos del outfit han sido agregado al carrito de compras")

        this.$root.displayToast({
          image_url: params.outfit.main_image_thumbnail,
          title: params.outfit.name,
          body: "Los productos del outfit han sido agregado al carrito de compras",
          link: process.env.MIX_APP_URL + "/checkout"
        });

        this.$store.commit('deactivateLoadingCart')
      } catch (error) {
        this.displayError(error.response.data.message)
        this.$store.commit('deactivateLoadingCart')
      }


    },
    async increaseProductQuantityInCart(product) {

      try {
        var params = {
          variant_id: product.id, // Its called product in cart, but ID is from variant
          quantity: product.quantity + 1,
        }
        if (localStorage.userId) {
          params.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.patch(process.env.MIX_API_URL + "/cart", params);
        this.cart = response.data.data
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
      } catch (error) {
        this.displayError(error.response.data.message)
      }
    },
    async decreaseProductQuantityInCart(product) {
      // console.log('decreasing qty', product)
      try {
        var params = {
          variant_id: product.id, // Its called product in cart, but ID is from variant
          quantity: product.quantity - 1,
        }
        if (localStorage.userId) {
          params.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.patch(process.env.MIX_API_URL + "/cart", params)
        this.cart = response.data.data
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
      } catch (error) {
        this.displayError(error.response.data.message)
      }
    },
    async removeProductFromCart(product) {
      // console.log('removing product', product)
      try {
        var params = {
          product_id: product.id
        }
        if (localStorage.userId) {
          params.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.post(process.env.MIX_API_URL + "/cart/remove", params);
        this.cart = response.data.data
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
        console.log(product)
        this.$root.displayToast({
          image_url: product.attributes.variant.product.main_image_thumbnail,
          title: product.name,
          body: "Se ha eliminado correctamente el artículo de tu carrito de compras"
        });
      } catch (error) {
        this.displayError(error.response.data.message)
      }
    },
    async calculateShippingCosts(address) {
      try {

        var params = {
          address_id: address.id,
        }
        if (localStorage.userId) {
          params.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.post(process.env.MIX_API_URL + "/shipping", params)

        this.cart = response.data.data
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
      } catch (error) {
        this.displayError(error.response ? error.response.data.message : error)
      }

    },

    async applyCoupon(code) {
      // console.log('Applying coupon', code)
      try {
        var params = {
          code: code
        }
        if (localStorage.userId) {
          params.userId = localStorage.userId
        }
        localStorage.removeItem('userId')
        var response = await axios.post(process.env.MIX_API_URL + "/cart/coupon", params);
        this.cart = response.data.data
        this.displaySuccess('El cupón ingresado ha sido aplicado con éxito')
        if (this.cart.userId) {
          localStorage.userId = this.cart.userId
        }
      } catch (error) {
        this.displayError(error.response.data.message)
        this.getCart();
      }
    },
    displayError(error) {
      this.$swal({
        type: "error",
        title: "UPS!",
        text: "No se pudo completar la operación: " + JSON.stringify(error),
      })
    },
    displaySuccess(message, onClose = null) {
      this.$swal({
        type: "success",
        title: "LISTO",
        text: message,
        onClose: function(modalElement) {
          console.log(modalElement);
          if(onClose) {
            onClose()
          }
        }
      });
    },
    displayInfo(message) {
      this.$swal({
        type: "info",
        text: message,
      });
    },

    displayToast(data) {
      this.$swal({
        html: `
        ${data.link ? ' <a href="'+data.link+'">' : ''}
         <div class="d-flex">

          <div class="img-sm-2 rounded-circle bg-cover bg-no-repeat" width="80px" style="background-image:url('${data.image_url}')">
          </div>
          <div>
          <div class="text-left pl-3 text-primary font-weight-bold pt-1"><strong>${data.title}</strong></div>
          <div class="text-left pl-3 text-primary text-sm">${data.body}</div>
          </div>
         </div>
         ${data.link ? '</a>' : ''}
        `,
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 10000
        // customClass: {
        // container: 'container-class',
        // popup: 'popup-class',
        // header: 'header-class',
        // title: 'title-class',
        // closeButton: 'close-button-class',
        // image: 'notification-toast-image',
        // content: 'content-class',
        // input: 'input-class',
        // actions: 'actions-class',
        // confirmButton: 'confirm-button-class',
        // cancelButton: 'cancel-button-class',
        // footer: 'footer-class'
        // }
      });
    },
    showModal(refName) {
      if (this.$refs[refName]) {
        this.$refs[refName].show();
      } else {
        console.error(refName + ' ref was not found');
      }
    },
    hideModal(refName) {
      if (this.$refs[refName]) {
        this.$refs[refName].hide();
      } else {
        console.error(refName + ' ref was not found');
      }
    },
    async getLoggedUser() {
      var url = process.env.MIX_API_URL + "/me"

      try {
        var response = await axios.get(url);
        // console.log('USER GET response: ', response);
        this.user = response.data.data;

        // console.log('USER ASSIGNED: ', this.user);
        if (this.user) {
          localStorage.userId = this.user.id
        }
      } catch (error) {
        // console.log('USER NOT LOGGED IN');
        this.user = null
        this.cart = []
      }
    },
    async saveFCMToken(token) {
      var url = process.env.MIX_API_URL + "/fcm"

      try {
        var response = await axios.post(url, {
          token: token
        });
        // console.log('FCM token saved: ', response);
      } catch (error) {
        console.error('FCM token not saved: ' + error);
      }
    },
    isVideo(url) {
      // Remove everything to the last slash in URL
      // extension = url.substr(1 + url.lastIndexOf("/"));

      // // Break URL at ? and take first part (file name, extension)
      // url = url.split("?")[0];

      // // Sometimes URL doesn't have ? but #, so we should aslo do the same for #
      // url = url.split("#")[0];

      // Now we have only extension
      let type = mime.getType(url);
      return type != undefined && type.includes("video");
    },
  },

  async created() {
    await this.getLoggedUser();

    if (this.user) {
      const messaging = firebase.messaging();
      messaging.usePublicVapidKey("BIyjWEZDMkd49mOViv6iOmbB-_N0kj07Gd1Ob5mvgUa_aUKkimpnNcR-AsfYgURhtTLcnQIe5_Wk72jeV7swLcc");

      try {
        messaging.useServiceWorker(await navigator.serviceWorker.register(process.env.MIX_APP_URL + '/firebase-messaging-sw.js'))
      } catch (err) {
        console.error('FCM Register failed', err)
        return
      }

      messaging.requestPermission().then(() => {
        messaging.getToken().then((currentToken) => {
          if (currentToken) {
            this.saveFCMToken(currentToken);
          } else {
            console.error('No Instance ID token available. Request permission to generate one.');
          }
        }).catch(function (err) {
          console.error('An error occurred while retrieving token. ', err);
        });
      }).catch(function (err) {
        console.error('Unable to get permission to notify.', err);
      });


      // Handle incoming messages. Called when:
      // - a message is received while the app has focus
      // - the user clicks on an app notification created by a service worker
      //   `messaging.setBackgroundMessageHandler` handler.
      messaging.onMessage((payload) => {
        console.log('Message received . ', payload.notification);

        if (!("Notification" in window)) {
          console.error("This browser does not support desktop notification");
        } else if (Notification.permission === "granted") {
          // If it's okay let's create a notification
          let options = {
            body: payload.notification.body,
            badge: payload.notification.icon,
            icon: payload.notification.icon,
            vibrate: true,
            click_action: payload.notification.click_action,
          }
          // Manually generate local notification
          let notification = new Notification(payload.notification.title, options)

          notification.onclick = function (event) {
            // * This is necessary to open on same tab
            event.preventDefault(); // prevent the browser from focusing the Notification's tab
            window.open(payload.notification.click_action, '_self'); // Open in active tab
          }
          // notification.addEventListener("close", function (event) {
          //   alert("onClose!");
          //   event.preventDefault();
          //   console.log('Notification clicked.');
          // })
        }

      });



    }
  }
})

  let mobArrowToggle = document.getElementById('mobMenuArrowToggle')
  let mobContainerToggle = document.getElementById('mobMenuContainerToggle')


  if(mobArrowToggle) {
    mobArrowToggle.addEventListener('click',function() {
    mobArrowToggle.classList.toggle('mob-menu--arrow__toggle')
    mobContainerToggle.classList.toggle('mob-menu--container__toggle')
  })
}
