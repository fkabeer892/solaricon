import {createStore} from "vuex";

const store = createStore({
  state: {
    user: {
      data: {
        name: "Fazle Kabeer Khan"
      },
      token: 123
    },
    globals: {
      origin: "http://localhost/clients/qazi-kamran/solaricon/public/api",
      gridType: "table"
    },
    data: []
  },
  getters: {},
  actions: {},
  mutations: {}
});

export default store;
