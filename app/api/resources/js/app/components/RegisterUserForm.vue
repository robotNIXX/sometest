<template>
  <VCard class="mx-auto" style="width: 400px; height: auto;">
    <VCardTitle>
      Register form
    </VCardTitle>
    <VCardItem>
      <VForm fast-fail @submit.prevent>
        <VTextField label="Name" v-model="registerForm.name" :error-messages="errors.name || []"/>
        <VAutocomplete @update:modelValue="selectCountry" v-model="registerForm.country" :items="countriesList"
                       :error-messages="errors.country || []"></VAutocomplete>
        <VTextField :prefix="phonePrefix" label="Phone" v-model="registerForm.phone"
                    :error-messages="errors.phone || []"></VTextField>
        <VTextField label="Email" v-model="registerForm.email" :error-messages="errors.email || []"></VTextField>
        <VBtn class="mt-2" type="submit" block @click="onSubmit">Submit</VBtn>
      </VForm>
    </VCardItem>
  </VCard>
</template>

<script setup lang="ts">
import {VCardTitle} from 'vuetify/components';
import {computed, onMounted, ref} from "vue";
import {useCountriesStore} from '../store/countries';
import axios from "axios";
import {da} from "vuetify/locale";

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

const errors = ref({})

const phonePrefix = computed(() => selectedCountry.value.idd)

const selectCountry = (el) => {
  const element = countriesStore.countries.filter((item: Country) => {
    return (item.flag + ' ' + item.name).indexOf(el) >= 0
  })

  selectedCountry.value = element[0]
}

const onSubmit = async () => {
  await axios.post('/api/auth/register', {
    name: registerForm.value.name,
    country: selectedCountry.value.name,
    phone: registerForm.value.phone,
    idd: selectedCountry.value.idd,
    email: registerForm.value.email
  }).catch((res) => {
    generateErrors(res.response.data)
  })
}

const generateErrors = (data) => {
  errors.value = []
  if (data.errors) {
    errors.value = data.errors
  }
}

onMounted(() => {
  countriesStore.fetchCountries()
})

</script>