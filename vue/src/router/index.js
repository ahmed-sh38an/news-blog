import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import CreatePost from "../views/CreatePost.vue";
import PostView from "../views/PostView.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import AdminView from "../views/admin/AdminView.vue";
import AdminLogin from "../views/admin/AdminLogin.vue";
import AdminRegister from "../views/admin/AdminRegister.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/news/:slug",
      name: "news",
      component: PostView,
    },
    {
      path: "/auth",
      name: "auth",
      redirect: "/login",
      component: AuthLayout,
      meta: { isGuest: true },
      children: [
        {
          path: "/login",
          name: "login",
          component: Login,
        },
        {
          path: "/register",
          name: "register",
          component: Register,
        },
      ],
    },
    {
      path: "/admin",
      name: "admin",
      redirect: "/admin/login",
      component: AuthLayout,
      meta: { isGuest: true },
      children: [
        {
          path: "/admin/login",
          name: "adminlogin",
          component: AdminLogin,
        },
        {
          path: "/admin/register",
          name: "adminregister",
          component: AdminRegister,
        },
      ],
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: AdminView,
      meta: { isAdmin: true },
    },
    {
      path: "/create",
      name: "create",
      component: CreatePost,
      meta: { isAdmin: true },
    },
  ],
});

router.beforeEach((to, from, next) => {
  if (to.meta.isGuest && store.state.user.token) {
    next({ name: "home" });
  } else if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "login" });
  } else if (to.meta.isAdmin && !store.state.user.admin) {
    next({ name: "adminlogin" });
  } else {
    next();
  }
});

export default router;
