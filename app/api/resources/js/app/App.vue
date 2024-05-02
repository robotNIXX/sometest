<template>
    <v-app  id="app">
      <VMain>
          <v-container >
            <RegisterUserForm/>
          </v-container>
      </VMain>
    </v-app>
</template>

<script>
import {VApp, VMain, VContainer} from "vuetify/lib/components"
import RegisterUserForm from './components/RegisterUserForm.vue'

export default ({
  name: 'App',
  components: {
    RegisterUserForm,VApp, VMain, VContainer
  },
})

</script>