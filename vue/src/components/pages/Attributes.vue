<script lang="ts">
import {defineComponent} from 'vue'
import {mapState} from "vuex";
import Grid from "../common/Grid.vue"


let attributes = [];

try {
  const data = await fetch("http://localhost/clients/qazi-kamran/solaricon/public/api/attribute");
  attributes = await data.json();
}
catch (err){
   console.log(err);
}

export default defineComponent({
  name: "Attributes",
  data() {
     return {
       attributes: attributes,
       columns: [{"key":"name", "label": "Name"}],
       actions: [{"key": "edit", "label": "Edit"}, {"key": "delete", "label": "Delete", "type": "critical"}]
     }
  },
  components: {
     "Grid": Grid
  }
})
</script>

<template>

    <h1>Attributes</h1>

    <Grid :data="attributes" :columns="columns" :actions="actions" />



</template>

<style scoped>

</style>
