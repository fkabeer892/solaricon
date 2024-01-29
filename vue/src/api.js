import axios from "axios";

const origin = "http://localhost/clients/qazi-kamran/solaricon/public/api";
const fetchData = async (endpoint, page, response, onError) => {
  try {

    let url = origin + endpoint + "?page=" + page;
    try {
      let keyword = document.getElementById('keyword').value;
      if (keyword !== "") url += "&keyword=" + keyword;
    } catch (err) {

    }
    const response = await fetch(url);
    let data = await response.json();
    console.log(data);
    response.value = data;
    return data;
  }
  catch( err) {
    console.log(err);
    //if(onError)     onError(err);
  }
}

const fetchRow = async (endpoint, onError) => {
  try {
    let url = origin + endpoint;
    const response = await fetch(url);
    let data = await response.json();
    console.log(data);
    return data;
  }
  catch( err) {
    console.log(err);
    if(onError) {
       onError(err);
    }
    //return err;
  }
}


const insert = async (endpoint, insertData, onError) => {
    try {
       const response = await axios.post(origin + endpoint, insertData);
       console.log(response);
       return response;
    }
    catch (e) {
      console.log(e);
      if(onError) onError(e);
    }
}

const update = async (endpoint, updateData, onError) => {
  try {
    const response = await axios.put(origin + endpoint, updateData);
    console.log(response);
    return response;
  }
  catch (e) {
    console.log(e);
    if(onError) onError(e);
  }
}

const remove = async (endpoint, onError) => {
  try {
    const response = await axios.delete(origin + endpoint);
    console.log(response);
    return response;
  }
  catch (e) {
    console.log(e);
    if(onError) onError(e);
  }
}

export {
  fetchData,
  fetchRow,
  insert,
  update,
  remove,
  origin
}
