import './bootstrap';

import {createApp} from 'vue'
import App from './app/App.vue'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import VueTheMask from 'vue-the-mask'

import { createPinia } from 'pinia'


const pinia = createPinia()

const vuetify = createVuetify({
  components,
  directives
})

createApp(App).use(vuetify).use(pinia).use(VueTheMask).mount('#app')
