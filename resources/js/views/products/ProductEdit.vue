<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <span v-if="product && product.id">Edit Product</span>
        <span v-else>Create Product</span>
      </h2>
    </template>
    <div class="md:flex">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg md:w-2/3 mr-4 bg-white">
        <h3 class="border-b p-4 font-semibold bg-gray-100">Informations</h3>
        <div class="p-6">
          <spinner
            v-if="loading"
            class="p-6"
          ></spinner>
          <product-form
            v-bind.sync="product"
            :errors="errors"
          >
            <template #actions>
              <base-button @click="$router.back()">Cancel</base-button>
              <primary-button
                class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="button"
                @click="submit"
              >
                Save
              </primary-button>
            </template>
          </product-form>
        </div>
      </div>
      <div class="md:w-1/3">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-4">
          <h3 class="border-b p-4 font-semibold">Manage stocks</h3>
          <div class="p-6 bg-white">
            <danger-button @click="showRemoveStockModal">Remove Stock</danger-button>
            <primary-button @click="showAddStockModal">Add Stock</primary-button>
          </div>
        </div>
        <div class="shadow border-b border-gray-200 sm:rounded-lg">
          <h3 class="border-b p-4 font-semibold">Last movements</h3>
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Action
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Quantity
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Price HT
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Date
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-if="loading">
                <td colspan="3">
                  <spinner></spinner>
                </td>
              </tr>
              <tr
                v-for="movement in product.movements"
                :key="movement.id"
              >
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                  {{ movement.action }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                  {{ movement.quantity }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                  {{ movement.price_ht }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                  {{ movement.created_at | moment("DD/MM/YYYY H:mm:ss") }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <add-quantity-modal
        :product="product"
        @added="onStockAdded"
      ></add-quantity-modal>
      <remove-quantity-modal
        :product="product"
        @removed="onStockRemoved"
      ></remove-quantity-modal>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout'
import Spinner from 'vue-simple-spinner'
import ProductForm from '@/views/products/components/ProductForm.vue'
import RemoveQuantityModal from '@/views/products/components/RemoveQuantityModal.vue'
import AddQuantityModal from '@/views/products/components/AddQuantityModal.vue'

export default {
  components: {
    AppLayout,
    Spinner,
    ProductForm,
    RemoveQuantityModal,
    AddQuantityModal
  },
  data () {
    return {
      product: {
        id: null,
        name: null,
        description: null,
        quantity: null,
        price_ht: null
      },
      loading: false,
      errored: false,
      errors: null
    }
  },
  mounted () {
    if (this.$route.params.id) {
      this.loading = true
      window.axios
        .get(`/api/products/${this.$route.params.id}`)
        .then((response) => {
          this.product = response.data.data
        })
        .catch(() => {
          this.errored = true
          this.$notify({
            group: 'app',
            type: 'error',
            title: 'An error occured while retrieving the product'
          })
        })
        .finally(() => (this.loading = false))
    }
  },
  methods: {
    submit () {
      window.axios
        .put(`/api/products/${this.product.id}`, this.product)
        .then((response) => {
          this.$notify({
            group: 'app',
            type: 'success',
            title: 'Product successfully updated'
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
            title: 'An error occurred while updating the product'
          })
        })
    },
    showAddStockModal () {
      this.$modal.show('add-stock-modal')
    },
    showRemoveStockModal () {
      this.$modal.show('remove-stock-modal')
    },
    onStockAdded (product) {
      this.product = product
    },
    onStockRemoved (product) {
      this.product = product
    }
  }
}
</script>
