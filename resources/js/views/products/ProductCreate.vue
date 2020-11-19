<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <span>Create Product</span>
      </h2>
    </template>
    <div class="md:flex">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg md:w-2/3 mr-4">
        <h3 class="border-b p-4 font-semibold">Informations</h3>
        <product-form
          v-bind.sync="product"
          :errors="errors"
          class="p-6"
        >
          <template #actions>
            <base-button @click="$router.back()">Cancel</base-button>
            <primary-button @click="submit">
              Save
            </primary-button>
          </template>
        </product-form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout'
import ProductForm from '@/views/products/components/ProductForm.vue'

export default {
  components: {
    AppLayout,
    ProductForm
  },
  data () {
    return {
      product: {
        name: null,
        description: null,
        quantity: null,
        price_ht: null
      },
      errors: null
    }
  },
  methods: {
    submit () {
      window.axios
        .post('/api/products', this.product)
        .then((response) => {
          this.$notify({
            group: 'app',
            type: 'success',
            title: 'Product successfully created'
          })
          this.$router.push({ name: 'products.index' })
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          }
          this.$notify({
            group: 'app',
            type: 'error',
            title: 'An error occurred while creating the product'
          })
        })
    }
  }
}
</script>
