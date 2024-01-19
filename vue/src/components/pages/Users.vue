<script lang="ts">
import {defineComponent} from 'vue'
import {mapState} from "vuex";
import Grid from "../common/Grid.vue"

let users = [];



export default defineComponent({
  name: "Users",
  data() {
     return {
       users: users,
       columns: [{"key":"name", "label": "Name"}, {"key":"email", "label": "Email"}],
       actions: [{"key": "edit", "label": "Edit"}, {"key": "delete", "label": "Delete", "type": "critical"}],
       endpoint: "user",
       type: "table"
     }
  },
  components: {
     "Grid": Grid
  }
})
</script>

<template>

    <h1>Users</h1>

  <Grid :columns="columns" :actions="actions" :type="type" :endpoint="endpoint" >
    <tr>
      <td>Fkabeer</td>
      <td>fkabeer@fkabeer.com</td>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </Grid>



</template>

<style scoped>

</style>
