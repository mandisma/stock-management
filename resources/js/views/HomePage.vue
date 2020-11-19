<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Homepage
      </h2>
    </template>
    <div>
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-6">
        <p class="text-center">Welcome to the stock management.</p>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout'

export default {
  components: {
    AppLayout
  }
}
</script>
