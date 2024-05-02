import {defineStore} from "pinia";
import axios from "axios";


export  const useCountriesStore = defineStore('countries', {
    state: () => (
        {
            countries: []
        }
    ),
    getters: {
        getCountries: (state) => state.countries
    },
    actions: {
        async fetchCountries() {
            return await axios.get('/api/countries').then((response) => {
                this.countries = response.data
            })
        }
    }
})