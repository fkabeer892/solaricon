<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Cell",
  props: ['cols']
})
</script>

<template>

    <td  class="whitespace-nowrap px-6 py-4 font-medium" :colspan=cols>
      <slot />
    </td>
</template>

<style scoped>

</style>
