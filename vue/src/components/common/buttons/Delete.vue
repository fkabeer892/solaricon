<script lang="js">
import {defineComponent, defineProps} from 'vue'
import {mapState}  from 'vuex'
//const props = defineProps(['identity', 'label', 'perform', 'endpoint'])

export default defineComponent({
  name: "Delete",
  props: ['identity', 'label',  'endpoint', 'deleteRow'],
  computed: {
    ...mapState(['globals'])
  },

})


</script>

<template>
  {{ perform }}
  <button id="identity" path="endpoint" v-on:click="deleteRow(identity)"   class="px-4 p-2 border  rounded-full bg-dark  bg-red-500 text-white" >Delete</button>

</template>

<style scoped>

</style>
