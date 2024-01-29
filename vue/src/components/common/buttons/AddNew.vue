<script lang="ts">
import {defineComponent, defineProps} from 'vue'
//const {to, label} = defineProps(['to', 'label']);

export default defineComponent({
  name: "AddNew",
  props: ['to','label']
})

</script>

<template>

  <router-link :to="to" class="px-8 p-3 border dark rounded-full bg-dark bg-black text-white" >{{ label ? label: "Add New" }}</router-link>
</template>

<style scoped>

</style>
