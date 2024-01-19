<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Cell"
})
</script>

<template>
    <td  class="whitespace-nowrap px-6 py-4 font-medium">
      <slot />
    </td>
</template>

<style scoped>

</style>
