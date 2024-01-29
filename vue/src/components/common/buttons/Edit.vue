<script lang="ts">
import {defineComponent, defineProps} from 'vue'

export default defineComponent({
  name: "Edit",
  props: ['to','label']
})

</script>

<template>
  <router-link :to="to" class="px-4 p-2 border dark rounded-full bg-dark bg-black text-white" >{{ label ? label: "Edit" }}</router-link>
</template>

<style scoped>

</style>
