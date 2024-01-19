import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
//import '../postcss.config.js';
import Auth from './components/layout/Auth.vue'
import store from './store'
import "./index.css"
import router from "./components/router"
import * as ConfirmDialog from 'vuejs-confirm-dialog'


createApp(App)
  .use(store)
  .use(router)
  .use(ConfirmDialog)
  .mount('#vite')
