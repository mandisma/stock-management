import HomePage from '@/views/HomePage.vue'
import ProductIndex from '@/views/products/ProductIndex.vue'
import ProductEdit from '@/views/products/ProductEdit.vue'
import ProductCreate from '@/views/products/ProductCreate.vue'
import LoginPage from '@/views/LoginPage.vue'

export default {
  mode: 'history',

  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage
    },
    {
      path: '/products',
      name: 'products.index',
      component: ProductIndex
    },
    {
      path: '/products/create',
      name: 'products.create',
      component: ProductCreate
    },
    {
      path: '/products/:id',
      name: 'products.edit',
      component: ProductEdit
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage
    }
  ]
}
