<template>
    <VCard class="mx-auto" style="width: 400px; height: auto;">
        <VCardTitle>
            Register form
        </VCardTitle>
      <VCardItem>
        <VForm fast-fail @submit.prevent>
          <VTextField label="Name" v-model="registerForm.name" />
          <VAutocomplete @update:modelValue="selectCountry" v-model="registerForm.country" :items="countriesList"></VAutocomplete>
          <VTextField :prefix="phonePrefix" label="Phone" v-model="registerForm.phone"></VTextField>
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
import axios from "axios";

interface Country {
  name: string
  flag: string
  idd: string
}

const selectedCountry = ref({
  name: '',
  flag: '',
  idd: '',
})

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

const phonePrefix = ref('')

const selectCountry = (el) => {
  const element = countriesStore.countries.filter((item:Country) => {
    return (item.flag + ' ' + item.name).indexOf(el) >= 0
  })

  phonePrefix.value = element[0].idd
}

const onSubmit = async () => {
  await axios.post('/api/auth/register', registerForm.value)
}

onMounted(() => {
  countriesStore.fetchCountries()
})

</script>