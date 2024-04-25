<template>
    <VCard class="mx-auto" style="width: 400px; height: auto;">
        <VCardTitle>
            Register form
        </VCardTitle>
      <VCardItem>
        <VForm fast-fail @submit.prevent>
          <VTextField label="Name" v-model="registerForm.name" />
          <VAutocomplete v-model="registerForm.country" :items="countriesList"></VAutocomplete>
          <VTextField label="Phone" v-model="registerForm.phone"></VTextField>
          <VTextField label="Email" v-model="registerForm.email"></VTextField>
          <VBtn class="mt-2" type="submit" block @click="onSubmit">Submit</VBtn>
        </VForm>
      </VCardItem>
    </VCard>
</template>

<script setup lang="ts">
import { VCardTitle } from 'vuetify/components';
import {computed, onMounted, ref} from "vue";
import { useCountriesStore } from '../store/countries';

interface Country {
  name: string
  flag: string
  idd: string
}

const countriesStore = useCountriesStore()
const countriesList = computed(() => {
  return countriesStore.countries.map((item: Country) => `${item.flag} ${item.name}`)
})

const registerForm = ref({
  name: '',
  country: '',
  phone: '',
  email: ''
})

const onSubmit = () => {
  console.log(registerForm.value)
}

onMounted(() => {
  countriesStore.fetchCountries()
})

</script>