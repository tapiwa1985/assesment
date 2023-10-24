import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginComponent from '../components/auth/LoginComponent'
import FetchBookingsComponent from '../components/bookings/FetchBookingsComponent';
import CreateBookingComponent from '../components/bookings/CreateBookingComponent'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {'layout': 'AuthLayout'}
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/login',
    component: LoginComponent,
    meta: {'layout': 'AuthLayout'}
  },
  {
    path: '/bookings',
    component: FetchBookingsComponent,
    meta: {'layout': 'DefaultLayout'}
  },
  {
    path: '/bookings/create',
    component: CreateBookingComponent,
    meta: {'layout': 'DefaultLayout'}
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
