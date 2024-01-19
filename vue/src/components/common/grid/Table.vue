<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Table",

})
</script>

<template>
  <table class="min-w-full text-center text-sm font-light">
    <slot />
  </table>
</template>

<style scoped>

</style>
