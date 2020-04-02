import Vue from 'vue'
import route from 'ziggy'
import { Ziggy } from './ziggy'
import Vuelidate from 'vuelidate'
import PortalVue from 'portal-vue'
import { InertiaApp } from '@inertiajs/inertia-vue'

Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(Vuelidate)
Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    }
});

const app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
