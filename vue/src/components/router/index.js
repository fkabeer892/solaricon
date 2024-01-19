import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../pages/Dashboard.vue";
import Auth from "../layout/Auth.vue";
import User from "../layout/User.vue";
import Guest from "../layout/Guest.vue";
import Login from "../pages/Login.vue";
import ForgotPassword from "../pages/ForgotPassword.vue";
import Attributes from "../pages/Attributes.vue";
import Users from "../pages/Users.vue";
import Status from "../pages/Status.vue";
import store from "../../store/index.js";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/dashboard',
      name: "Dashboard",
      component: User,
      meta: {needsAuth: true},
      children: [
        {path: '/', name: "Dashboard", component: Dashboard},
        {path: '/attributes', name: "Attributes", component: Attributes},
        {path: '/users', name: "Users", component: Users},
        {path: '/status', name: "Status", component: Status},
      ]
    },
    {
      path: '/',
      name: "Guest",
      component: Guest,
      meta: {guest: true},
      children: [
        {
          path: '/login',
          name: "Login",
          component: Login
        },
        {
          path: '/forgot-password',
          name: "forgotPassword",
          component: ForgotPassword
        },
      ]
    }
  ]
});
/*
router.beforeEach((to, from, next) => {
  if (to.meta.needsAuth && !store.state.user.token) {
    next({name: "Login"});
  } else if (store.state.user.token && to.meta.guest) {
    next({name: 'Dashboard'});
  }
  else {
     next();
  }
})*/

export default router;
