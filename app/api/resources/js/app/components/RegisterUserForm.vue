<template>
  <VCard class="mx-auto" style="width: 400px; height: auto;">
    <VCardTitle>
      Register form
    </VCardTitle>
    <VCardText>
      <VForm fast-fail @submit.prevent>
        <VTextField label="Name" v-model="registerForm.name" :error-messages="errors.name || []"/>
        <VAutocomplete @change="selectCountry" v-model="registerForm.country" :items="countriesList"
                       :error-messages="errors.country || []"></VAutocomplete>
        <VTextField v-mask="'## ###-##-##'" :prefix="phonePrefix" label="Phone" v-model="registerForm.phone"
                    :error-messages="errors.phone || []"></VTextField>
        <VTextField label="Email" v-model="registerForm.email" :error-messages="errors.email || []"></VTextField>
        <VBtn type="submit" block @click="onSubmit">Submit</VBtn>
      </VForm>
    </VCardText>
  </VCard>
</template>

<script>
import {VCard, VForm, VCardTitle, VTextField, VCardText, VAutocomplete, VBtn} from "vuetify/lib/components";
import {useCountriesStore} from '../store/countries';
import axios from "axios";


export default({
  name: 'RegisterUserForm',
  components: {
    VCard,
    VCardText,
    VForm,
    VCardTitle,
    VTextField, VAutocomplete,
    VBtn
  },
  data: () => ({
    selectedCountry: null,
    countries: [],
    registerForm: {
      name: '',
      country: '',
      phone: '',
      email: ''
    },
    errors: {},
    phonePrefix: ''
  }),
  methods: {
    selectCountry(el) {
      const element = this.countries.filter((item) => {
        return (item.flag + ' ' + item.name).indexOf(el) >= 0
      })

      this.selectedCountry = element[0]
      cons
    },
    async onSubmit () {
      await axios.post('/api/auth/register', {
        name: this.registerForm.name ?? '',
        country: this.selectedCountry ? this.selectedCountry.name : '',
        phone: this.registerForm.phone ?? '',
        idd: this.selectedCountry ? this.selectedCountry.idd : '',
        email: this.registerForm.email ?? ''
      }).catch((res) => {
        this.generateErrors(res.response.data)
      })
    },
    generateErrors(data) {
      this.errors = {}
      if (data.errors) {
        this.errors = data.errors
      }
    }
  },
  watch: {
    selectedCountry(value) {
      this.phonePrefix = value.idd
    }
  },
  computed: {
    countriesList() {
      const list = this.countries.map((item) => {
        return item.flag + ' ' + item.name
      })

      return list
    }
  },
  mounted() {
    useCountriesStore().fetchCountries()
    this.countries = useCountriesStore().getCountries
  }
})

</script>