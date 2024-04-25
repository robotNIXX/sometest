
<template>
    <VApp>
        <VMain class="d-flex justify-center">
          <VContainer >
            <RegisterUserForm/>
          </VContainer>
        </VMain>
    </VApp>
</template>

<script setup lang="ts">

import { VApp } from 'vuetify/components';
import RegisterUserForm from './components/RegisterUserForm.vue'

</script>