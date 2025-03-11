import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/admission status",
      name: "admission status",
      component: () => import("../views/AdmissionStatus.vue"),
    },
    {
      path: "/sundry payment",
      name: "sundry payment",
      component: () => import("../views/SundryPayment.vue"),
    },
    {
      path: "/e-bursary",
      name: "e-bursary",
      component: () => import("../views/EBursary.vue"),
    },
    {
      path: "/e-transcript",
      name: "e-transcript",
      component: () => import("../views/ETranscript.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginPage.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterPage.vue"),
      },
  ],
});

export default router
