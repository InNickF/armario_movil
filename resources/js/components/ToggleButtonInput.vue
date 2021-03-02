<template>
  <div>
    <toggle-button
      v-if="val != null"
      color="#181b48"
      :labels="{checked: 'Sí', unchecked: 'No'}"
      v-model="val"
      @change="onChangeEventHandler"
    />
    <input type="checkbox" v-model="val" :name="fieldName" value="1" hidden />
  </div>
</template>

<script>
export default {
  props: {
    value: null,
    fieldName: null
  },
  data() {
    return {
      val: null
    };
  },
  computed: {
    getVal() {
      return this.val === true ? true : false;
    }
  },
  mounted() {
    // if(this.value == null || !this.value.length || this.value == false || this.value == 0) {
    //   this.val = false;
    // } else {
    //   this.val = true;
    // }

    this.val = this.value === true || this.value == 1 ? true : false;
    // this.val = this.value === 1
  },
  methods: {
    onChangeEventHandler(ev) {
      this.$emit("on-changed", ev.value);
      // this.val = ev.value
    }
  }
};
</script>
