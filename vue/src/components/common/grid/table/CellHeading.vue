<script setup>
import {defineComponent, defineProps} from 'vue'

/*
console.log(props);
export default defineComponent({
  name: "CellHeading",
  //props: ['columns'],
  data(){
     return {
        columns: []
     }
  }
})
*/

</script>

<template>
  <th><slot/></th>
</template>

<style scoped>

</style>
