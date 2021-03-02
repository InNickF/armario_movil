<template>
  <div class="col-sm-12">
    <div class="my-3">
      <div class="mb-4 d-block w-100">
        <GmapMap
          ref="mapRef"
          :center="{lat:orderItem.order.shipping_address.latitude, lng:orderItem.order.shipping_address.longitude}"
          :zoom="14"
          style="width: 100%; height: 400px"
        >
          <GmapMarker
            ref="marker"
            :key="orderItem.id"
            :position="{lat:lat, lng:lng}"
            :clickable="false"
            :draggable="false"
            :icon="{url: baseUrl + '/images/icons/glovo-icon.png'}"
          />
          <GmapMarker
            ref="marker"
            :key="orderItem.id + 'destiny'"
            :position="{lat:orderItem.order.shipping_address.latitude, lng:orderItem.order.shipping_address.longitude}"
            :clickable="false"
            :draggable="false"
            :icon="{url: baseUrl + '/images/icons/house-icon.png'}"
          />
          <GmapMarker
            ref="marker"
            :key="orderItem.id + 'store'"
            :position="{lat:orderItem.product_variant.product.store.address.latitude, lng:orderItem.product_variant.product.store.address.longitude}"
            :clickable="false"
            :draggable="false"
            :icon="{url: baseUrl + '/images/icons/store-icon.png'}"
          />
        </GmapMap>

      </div>
    </div>
  </div>
</template><!-- Address Field -->


<script>
export default {
  props: {
    orderItem: null,
  },
  data() {
    return {
      lat: null,
      lng: null,
      baseUrl: process.env.MIX_APP_URL,
      showMap: false,
      timeoutId: null
    };
  },

  methods: {
    // getLocation() {
    //   // TODO: Request from api
    //   this.lat = event.latLng.lat();
    //   this.lng = event.latLng.lng();
    // },
    async getTrackingLocation() {
      var url = this.baseUrl + "/api/order_items/" + this.orderItem.id + '/track';

      try {
        var response = await axios.get(url);
        var location = response.data.data;

        if(location.lat && location.lon) {
          this.lat = location.lat;
          this.lng = location.lon;
          this.showMap = true;
        }
      } catch (error) {
        this.location = [];
      }
    },

  },

  mounted() {
    // TODO: Establish a tomeout to repeat each 2 secs
        this.timeoutId = setInterval(() => {
           this.getTrackingLocation();
          },
          2000
        );

    // this.$refs.mapRef.$mapPromise.then((map) => {
    //   map.panTo({lat: 1.38, lng: 103.80})
    // })

    // this.$refs.mapRef.$on('click', (event) => {
    //   console.log(event);
    //   this.latitude = parseFloat(event.latLng.lat)
    //   this.longitude = parseFloat(event.latLng.lng)
    //   this.$refs.marker.setPosition(event.latLng)
    // })
  }
};
</script>
