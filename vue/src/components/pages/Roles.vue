<script setup>
import { ref, getCurrentInstance } from 'vue'

import {fetchData, insert, update, remove, origin} from "../../api";
import {mapState} from "vuex";



/*export default defineComponent({
  name: "Role"
})*/

let data = {};

const response = ref({});
const componentKey = ref(0);
const getData = async (page) => {

  let url = origin +  "/role?page=" + page;
//  const data =
//...mapState(['data']);
  try {
    let keyword = document.getElementById('keyword').value;
    if (keyword !== "") url += "&keyword=" + keyword;
  } catch (err) {

  }
  const result = await fetch(url);
  response.value = await result.json();
  //forceUpdate();
  componentKey.value += 1;
  console.log(response.value);
  //response.value = data;
  //return data;


}


/*const forceUpdate = () => {
  const instance = getCurrentInstance();
  console.log(instance);
  instance.proxy.forceUpdate();
}*/

insert("/role", {"name": "Dummy"});



//onMounted(  () => getData(1));

await getData(1);

try{
  data = response.value.data;
  console.log(data);
}
catch (e){
  console.log(e);
}

</script>

<template>
    {{ response.value.data }}
    <table>
        <thead>
          <tr>
            <th>Name</th>
          </tr>
        </thead>
        <tbody >
           <tr v-for="(role, index) in response.value.data">
              <td>{{ role.name }}</td>
           </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
