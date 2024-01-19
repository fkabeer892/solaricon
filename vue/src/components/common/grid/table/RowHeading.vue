<script setup>
import {defineComponent, defineProps} from 'vue'
const props = defineProps(['columns', 'actions']);
/*
console.log(props);
export default defineComponent({
  name: "RowHeading",
  //props: ['columns'],
  data(){
     return {
        columns: []
     }
  }
})
*/
console.log(props);
</script>

<template>
    <thead>
        <tr>
          <th v-for="(column, key) in props.columns" :key="{key}">{{ column.label }}</th>
          <th v-for="(action, key) in props.actions" :key="{key}">{{ action.label }}</th>
        </tr>
    </thead>
</template>

<style scoped>

</style>
