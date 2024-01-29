<script lang="ts">
import {defineComponent} from 'vue'
import {mapState} from "vuex";
import axios from "axios";

import Table from "../common/grid/Table.vue";
import TableRowHeading from "../common/grid/table/RowHeading.vue";
import TableCellHeading from "../common/grid/table/CellHeading.vue";
import TableRow from "../common/grid/table/Row.vue";
import Paginator from "../common/grid/Paginator.vue";
import TableCell from "../common/grid/table/row/Cell.vue"
import AddNew from "../common/buttons/AddNew.vue";
import Edit from "../common/buttons/Edit.vue";
import Delete from "../common/buttons/Delete.vue";
import { isProxy, toRaw, ref } from 'vue';

import ModalDialog from '../common/ConfirmDialog.vue'
import { createConfirmDialog } from 'vuejs-confirm-dialog'

const dialog = createConfirmDialog(ModalDialog)





//if(props.type == "table"){
const Container = Table;
const Row = TableRow;
const RowHeading = TableRowHeading;
const Cell = TableCell;
//}

const hi = () => console.log("hi");


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


const response = ref({"meta":{}});
/*
const deleteRow = (id) => {
  console.log(id);
  return ;
  axios.delete("http://localhost/clients/qazi-kamran/solaricon/public/api/branch/" + id).then(
    (response) => this.fetchData(this.currentPage)
  ).catch( (err) =>{
    console.log(err);
  } );
}*/

export default defineComponent({
  name: "Branches",
  mounted() {
    //this.getData(1);
    /*let page = 1;
    let url = "http://localhost/clients/qazi-kamran/solaricon/public/api/branch?page=" + page;
    try {
      let keyword = ""; //document.getElementById('keyword').value;
      if (keyword !== "") url += "&keyword=" + keyword;
    }
    catch (err){

    }
    const response = fetch(url).then( async (response) => {
      this.response = await response.json();
      console.log(response.json());
    }).catch( (err) => console.log(err))*/

    this.fetchData(1);




  },
  computed: {
    ...mapState(['user', 'globals'])
  },
  data() {
     return {
       columns: [{"key":"name", "label": "Name"}, {"key":"object", "label": "Object"}],
       actions: [{"key": "edit", "label": "Edit"}, {"key": "delete", "label": "Delete", "type": "critical", "method": "delete"}],
       endpoint: "branch",
       type: "table",
       response:  response,
       currentPage: 1
     }
  },
  methods: {
    getData: async (page) => {
      try {
        console.log(page, !isNaN(page) );
        if(isNaN(page)) page = 1;

        //let url = this.globals.origin + this.endpoint + "?page=" + page;
        let url = "http://localhost/clients/qazi-kamran/solaricon/public/api/branch?page=" + page;
        try {
          let keyword = document.getElementById('keyword').value;
          if (keyword !== "") url += "&keyword=" + keyword;
        }
        catch (err){

        }
        const response = await fetch(url);
        let responseData = await response.json();
        response.value = responseData;
        console.log(response.value, globals);
        //return responseData;

      }
      catch (err){
        console.log(err);
      }
    },

    fetchData(page) {

      this.currentPage = page;
      let url = "http://localhost/clients/qazi-kamran/solaricon/public/api/branch?page=" + page;
      try {
        let keyword = document.getElementById('keyword').value;
        if (keyword !== "") url += "&keyword=" + keyword;
      }
      catch (err){

      }
      const response = fetch(url).then( async (response) => {
        this.response = await response.json();
        console.log(this.response);
      }).catch( (err) => console.log(err))
    },

    perform: (action) => {
      action = toRaw(action);
      console.log(action)
      //if(action.type == "critical"){


      confirmDelete();



      //}
    },

    tester(){
        console.log("I am testing");
    },

    deleteRow: (id) => {
       console.log(id);
       return ;
       axios.delete("http://localhost/clients/qazi-kamran/solaricon/public/api/branch/" + id).then(
         (response) => this.fetchData(this.currentPage)
       ).catch( (err) =>{
          console.log(err);
       } );
    }
  },
  components: {
     "TableCell": TableCell,
     "Cell": Cell,
     "Table": Table,
     "TableRow": TableRow,
     "Row": TableRow,
     "TableRowHeading": TableRowHeading,
     "RowHeading": TableRowHeading,
     "TableCellHeading": TableCellHeading,
     "CellHeading": TableCellHeading,
     "Container": Table,
     "Paginator": Paginator,
     "AddNew": AddNew,
     "Edit": Edit,
     "Delete": Delete
  }
})
</script>

<template>
  {{ user }}
  {{ globals }}
  <button v-on:click="tester">Test It</button>
  <div class="flex  flex-row flex-row justify-between p-5 ">
  <div class=""><AddNew to="/branch/add" label="Add New Branch"  /></div>
  <div class="border-bottom-dark rounded-full border p-3">
    Search: <input  class="border-0 rounded-full" name="keyword" id="keyword" v-on:keyup="(e)=>fetchData(1)">
  </div>
  </div>


  <Container>
    <RowHeading >
       <Row>
        <CellHeading>Name</CellHeading>
        <CellHeading>Address</CellHeading>
        <CellHeading>Area</CellHeading>
        <CellHeading>City</CellHeading>
        <CellHeading>Province</CellHeading>
        <CellHeading>Edit</CellHeading>
        <CellHeading>Delete</CellHeading>
       </Row>
    </RowHeading>
    <tbody v-if="(typeof response.data == 'object')">
    <Row v-for="(row, key) in response.data">
      <Cell>{{ row.name }}</Cell>
      <Cell>{{ row.contact.address }}</Cell>
      <Cell>{{ row.contact.area }}</Cell>
      <Cell>{{ row.contact.city }}</Cell>
      <Cell>{{ row.contact.state }}</Cell>
      <Cell  ><Edit to="" v-on:click="perform({})">Edit</Edit></Cell>
      <Cell  ><Delete  :identity="row.id" :deleteRow="deleteRow"  :endpoint="endpoint" :label="Delete">Delete</Delete> </Cell>
    </Row>
    <tbody v-if="(typeof response.data != 'object' || response.data.length == 0)">
    <Row >
      <Cell colspan="6">No branch found</Cell>
    </Row>
    </tbody>

    </tbody>
    <slot />
  </Container>



  <Paginator :meta="response.meta" :getData="getData" :current="currentPage" ></Paginator>

{{ hi }}

</template>

<style scoped>

</style>
