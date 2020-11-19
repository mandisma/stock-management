import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'
import store from './store'
import routes from './router'
import Notifications from 'vue-notification'
import vmodal from 'vue-js-modal'
import Paginate from 'vuejs-paginate'

require('./bootstrap')

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(require('vue-moment'))
Vue.use(Notifications)
Vue.use(vmodal)
Vue.component('paginate', Paginate)

// Get components
const requireComponent = require.context(
  // Le chemin relatif du dossier composants
  './components',
  // Suivre ou non les sous-dossiers
  false,
  // L'expression régulière utilisée pour faire concorder les noms de fichiers de composant de base
  /[A-Z]\w+\.(vue|js)$/
)

// Autoload components
requireComponent.keys().forEach(fileName => {
  // Récupérer la configuration du composant
  const componentConfig = requireComponent(fileName)

  // Récupérer le nom du composant en PascalCase
  const componentName = upperFirst(
    camelCase(
      // Retrouver le nom du fichier indépendemment de la profondeur de dossier
      fileName
        .split('/')
        .pop()
        .replace(/\.\w+$/, '')
    )
  )

  // Créer un composant global
  Vue.component(
    componentName,
    // Chercher les options du composant dans `.default`, qui
    // existera si le composant a été exporté avec `export default`,
    // sinon revenez à la racine du module.
    componentConfig.default || componentConfig
  )
})

const router = new VueRouter(routes)

router.beforeEach((to, from, next) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login']
  const authRequired = !publicPages.includes(to.path)
  const loggedIn = localStorage.getItem('user')

  if (authRequired && !loggedIn) {
    return next('/login')
  }

  next()
})

new Vue({
  store: new Vuex.Store(store),
  router
}).$mount('#app')
