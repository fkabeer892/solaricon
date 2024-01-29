<script setup>
const props = defineProps(["columns", "actions", "type", "endpoint"])
import Table from "./grid/Table.vue";
import TableRowHeading from "./grid/table/RowHeading.vue";
import TableRow from "./grid/table/Row.vue";
import Paginator from "./grid/Paginator.vue";
import TableCell from "./grid/table/row/Cell.vue"
import { isProxy, toRaw, ref } from 'vue';

import ModalDialog from '../common/ConfirmDialog.vue'
import { createConfirmDialog } from 'vuejs-confirm-dialog'

const dialog = createConfirmDialog(ModalDialog)


//props.data.data = {}



const data = ref({"meta":{}});
let currentPage = 1;


const getData = async (page) => {
  try {
    console.log(page, !isNaN(page) );
    if(isNaN(page)) page = 1;
    currentPage = page;
    let url = origin + props.endpoint + "?page=" + page;
    try {
      let keyword = document.getElementById('keyword').value;
      if (keyword !== "") url += "&keyword=" + keyword;
    }
    catch (err){

    }
    const response = await fetch(url);
    let responseData = await response.json();
    console.log(responseData);
    //return responseData;
    data.value = responseData;

  }
  catch (err){
    console.log(err);
  }
}


getData();

//if(props.type == "table"){
    const Container = Table;
    const Row = TableRow;
    const RowHeading = TableRowHeading;
    const Cell = TableCell;
//}

/*let columns = [];
for(let item in props.columns) {
  columns.push(props.columns[item])
}

*/

const titles = toRaw(props.columns);
const commands = toRaw(props.actions);
//console.log(titles);

//import {defineComponent} from 'vue'
import InputText from "./form/Input.vue";


const attr = {"size": 10, "name": "email", "class": "form-control"}

const navigate = () => getData;

const confirmDelete = async () => {
  const dialog = createConfirmDialog(ModalDialog)
  const { data, isCanceled } = await dialog.reveal()

  if(isCanceled) return

  console.log(data);
}

const perform = (action) => {
   action = toRaw(action);
   console.log(action)
   //if(action.type == "critical"){


  confirmDelete();



  //}
}

console.log(data);

</script>

<template>


          <div class="text-right">
            Search: <input type="text" name="keyword" id="keyword" v-on:keydown="(e)=>getData(1)">
          </div>


          <Container>
            <RowHeading :columns=titles :actions="commands">

            </RowHeading>
            <tbody v-if="(typeof data.data == 'object')">
            <Row v-for="(row, key) in data.data">
              <Cell v-for="(column, index) in props.columns">
                {{ row[column.key] }}
              </Cell>
              <Cell v-for="(action, index) in props.actions" ><div v-on:click="perform(action)">{{ action.label }}</div></Cell>
            </Row>

            </tbody>
            <slot />
          </Container>

  <Paginator :meta="data.meta" :getData="getData" :current="currentPage" ></Paginator>







</template>
<!--
<style scoped>

</style>-->
