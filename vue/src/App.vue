<script >
import HelloWorld from './components/HelloWorld.vue'
import {mapState} from "vuex";

import ModalDialog from './components/common/ConfirmDialog.vue'
import { createConfirmDialog } from 'vuejs-confirm-dialog'

const { reveal, onConfirm, onCancel } = createConfirmDialog(ModalDialog)

reveal()

onConfirm(() => {
  console.log('Confirmed!')
})
onCancel(() => {
  console.log('Canceled!')
})

export default {
  //components: HelloWorld,
  computed: {
    ...mapState(['user'])
  }
}
</script>

<template>
  <router-view></router-view>
</template>

<style scoped>

</style>
