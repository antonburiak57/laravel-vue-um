import Vue from 'vue'
import App from './components/Root.vue'
import routes from './routes/index'
import store from './stores/index'
import BootstrapVue from 'bootstrap-vue'
import i18n from "./i18n.js"

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false;

Vue.use(BootstrapVue)

new Vue({
    el: '#app',
    router: routes,
    store: store,
    i18n,
    render: h => h(App)
})
