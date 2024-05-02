import './bootstrap';

import Vue from 'vue'
import App from './app/App.vue'
import '@mdi/font/css/materialdesignicons.css'
import VueMask from 'v-mask'
import Vuetify from 'vuetify'


import { createPinia, PiniaVuePlugin } from 'pinia'
Vue.use(PiniaVuePlugin)
Vue.use(Vuetify)
Vue.use(VueMask)
const pinia = createPinia()
const vuetify = new Vuetify()
// createApp(App).use(Vuetify).use(pinia).use(VueTheMask).mount('#app')
new Vue({
    vuetify,
    pinia,
    render: (h) => h(App),
}).$mount('#app')