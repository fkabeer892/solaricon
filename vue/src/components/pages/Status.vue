<script lang="ts">
import {defineComponent} from 'vue'
import {mapState} from "vuex";
import Grid from "../common/Grid.vue"

export default defineComponent({
  name: "Status",
  data() {
     return {
       columns: [{"key":"name", "label": "Name"}, {"key":"object", "label": "Object"}],
       actions: [{"key": "edit", "label": "Edit"}, {"key": "delete", "label": "Delete", "type": "critical", "method": "delete"}],
       endpoint: "status",
       type: "table"
     }
  },
  components: {
     "Grid": Grid
  }
})
</script>

<template>

    <h1>Status</h1>

  <Grid :columns="columns" :actions="actions" :type="type" :endpoint="endpoint" >

  </Grid>



</template>

<style scoped>

</style>
