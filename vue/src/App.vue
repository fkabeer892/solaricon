<script >
import HelloWorld from './components/HelloWorld.vue'
import {mapState} from "vuex";

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
