<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Products
      </h2>
      <router-link
        class="bg-blue-500 hover:bg-blue-600 focus:outline-none rounded-lg px-6 py-2 text-white font-semibold shadow"
        :to="{ name: 'products.create' }"
      >Add</router-link>
    </template>
    <div class="py-6">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
          <thead>
            <tr class="bg-gray-50">
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                ID
              </th>
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Quantity
              </th>
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Price HT
              </th>
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Last update
              </th>
              <th class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-right">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr
              v-if="loading"
              class="text-center mx-auto"
            >
              <td colspan="6">
                <spinner></spinner>
              </td>
            </tr>
            <tr
              v-if="errored"
              class="text-center mx-auto"
            >
              <td colspan="6">
                An error occurred while retrieving the products
              </td>
            </tr>
            <tr
              v-for="product in products"
              :key="product.id"
            >
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ product.id }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ product.name }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ product.quantity }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ product.price_ht }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ product.created_at | moment("DD/MM/YYYY H:mm:ss") }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium text-gray-500">
                <button @click="deleteProduct(product.id)" class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                /
                <router-link
                  :to="{ name: 'products.edit', params: { id: product.id } }"
                  class="text-blue-600 hover:text-blue-900"
                >Edit</router-link>
              </td>
            </tr>
          </tbody>
          <tfoot v-if="pagination.total !== 0">
            <tr>
              <td colspan="6">
                <div class="bg-white px-4 py-3 flex items-center justify-between sm:px-6">
                  <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                      <p class="text-sm leading-5 text-gray-700">
                        Showing
                        <span class="font-medium">{{pagination.from}}</span>
                        to
                        <span class="font-medium">{{pagination.to}}</span>
                        of
                        <span class="font-medium">{{pagination.total}}</span>
                        results
                      </p>
                    </div>
                    <div v-if="pagination.last_page > 1">
                      <paginate
                        v-model="currentPage"
                        :page-count="pagination.last_page"
                        :click-handler="getProducts"
                        prev-text="<"
                        next-text=">"
                        container-class="relative z-0 inline-flex shadow-sm pagination"
                        page-link-class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        next-link-class="-ml-px relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        prev-link-class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                      >
                      </paginate>
                    </div>
                  </div>
                </div>

              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout'
import Spinner from 'vue-simple-spinner'

export default {
  components: {
    AppLayout,
    Spinner
  },
  data () {
    return {
      products: [],
      loading: true,
      errored: false,
      pagination: {
        total: 0,
        from: 0,
        to: 0,
        last_page: 0
      },
      currentPage: 1
    }
  },
  mounted () {
    this.getProducts()
  },
  methods: {
    getProducts () {
      this.loading = true
      this.products = []
      window.axios
        .get(`/api/products?page=${this.currentPage}`)
        .then((response) => {
          this.products = response.data.data
          this.pagination.total = response.data.meta.total
          this.pagination.from = response.data.meta.from
          this.pagination.to = response.data.meta.to
          this.pagination.last_page = response.data.meta.last_page
        })
        .catch((error) => {
          console.log(error)
          this.errored = true
          this.$notify({
            group: 'app',
            type: 'error',
            title: 'An error occured'
          })
        })
        .finally(() => (this.loading = false))
    },
    deleteProduct (productId) {
      window.axios
        .delete(`/api/products/${productId}`)
        .then((response) => {
          this.$notify({
            group: 'app',
            type: 'success',
            title: 'Product successfully deleted'
          })
          this.currentPage = 1
          this.getProducts()
        })
        .catch(() => {
          this.$notify({
            group: 'app',
            type: 'error',
            title: 'An error occurred while deleting the product'
          })
        })
    }
  }
}
</script>
