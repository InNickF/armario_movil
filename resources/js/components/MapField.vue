<template>
  <div class="col-sm-12">
    <div class="form-group text-primary h5">
      <label for="address">Dirección</label>
      <input
        type="text"
        name="address"
        class="form-control"
        v-model="address"
        placeholder="Ingresa las calles..."
      />
    </div>

    <div class="my-3">
      <div class>
        <div class="h5 text-primary">Georeferencia</div>
      </div>
      <div class="mb-4 d-block w-100">
        <GmapMap
          ref="mapRef"
          :center="{lat:lat, lng:lng}"
          :zoom="13"
          style="width: 100%; height: 300px"
        >
          <GmapMarker
            ref="marker"
            :key="address.id"
            :position="{lat:lat, lng:lng}"
            :clickable="false"
            :draggable="true"
            @dragend="moveMarker"
          />
        </GmapMap>

        <input type="text" v-model="lat" name="latitude" hidden />
        <input type="text" v-model="lng" name="longitude" hidden />
      </div>
    </div>
  </div>
</template><!-- Address Field -->


<script>
export default {
  props: {
    address: null,
    latitude: null,
    longitude: null
  },
  data() {
    return {
      lat: null,
      lng: null
    };
  },

  methods: {
    getLocation() {
      this.getLat();
      this.getLng();
    },

    getLat() {
      this.lat =
        this.latitude != null && this.latitude.length
          ? parseFloat(this.latitude)
          : parseFloat(process.env.MIX_GOOGLE_MAPS_DEFAULT_LAT);
    },
    getLng() {
      this.lng =
        this.longitude != null && this.longitude.length
          ? parseFloat(this.longitude)
          : parseFloat(process.env.MIX_GOOGLE_MAPS_DEFAULT_LNG);
    },
    moveMarker(event) {
      this.lat = event.latLng.lat();
      this.lng = event.latLng.lng();
    }
  },

  mounted() {
    this.getLocation();

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