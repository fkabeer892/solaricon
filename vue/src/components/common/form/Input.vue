<script setup>
import {defineProps} from 'vue'

const props = defineProps(['attr'])

const attrName = props.attr.name;
const attrClass = props.attr.class;
const attrType = (typeof props.attr.type != "string") ? "text" : props.attr.type ;
const attrSize = (typeof props.attr.size != "number") ? "text" : props.attr.size ;

let attributes = "";

for( let item in props.attr ){
   attributes += ` ${item}="${props.attr[item]}" `;
}

</script>

<template>

  <input name=:props.attr.name class=attrClass type=attrType size=45  />
</template>

<style scoped>

</style>
