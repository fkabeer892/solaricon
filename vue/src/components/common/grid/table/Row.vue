<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: "Row"
})
</script>

<template>
    <tr  class="border-b dark:border-neutral-500" >
      <slot />
    </tr>
</template>

<style scoped>

</style>
