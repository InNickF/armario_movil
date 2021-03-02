<template>
  <div>
    <vue-nestable v-model="categories" :maxDepth="maxDepth" class="mb-5">
      <vue-nestable-handle slot-scope="{ item }" :item="item">
        <i class="fas fa-bars mr-2" />
        <span>{{ item.name }}</span>
        <span>
          <a
            :href="baseUrl + '/admin/'+segment+'/' + item.id + '/edit'"
            class="btn btn-sm btn-primary text-white"
          >
            <i class="fa fa-edit"></i>
          </a>
        </span>
      </vue-nestable-handle>
    </vue-nestable>
    <input type="text" hidden :value="JSON.stringify(categories)" name="categories" />
  </div>
</template>

<script>
import { VueNestable, VueNestableHandle } from "vue-nestable";

export default {
  components: {
    VueNestable,
    VueNestableHandle
  },
  props: {
    categories: {
      type: Array,
      default: []
    },
    maxDepth: {
      type: Number,
      default: 1
    },
    title: String,
    segment: null
  },
  data() {
    return {
      baseUrl: process.env.MIX_APP_URL
    };
  },

  methods: {
    save() {}
  },

  mounted() {}
};
</script>