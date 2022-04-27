import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import trucksView from '../views/trucksView.vue'
import aboutView from '../views/AboutView.vue'
import MaintenanceView from '../views/MaintenanceView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/Login',
    name: 'Login',
    component: LoginView,
  },
  {
    path: '/Trucks',
    name: 'trucks',
    component: trucksView,
  },
  {
    path: '/Maintenance',
    name: 'maintenance',
    component: MaintenanceView,

  },
  {
    path: '/About',
    name: 'about',
    component: aboutView,
  },

]

const router = new VueRouter({
  routes
})

export default router