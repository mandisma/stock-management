<template>
  <modal
    name="add-stock-modal"
    height="auto"
  >
    <div class="p-6">
      <div
        v-if="errors"
        class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg"
      >
        <div
          v-for="(v, k) in errors"
          :key="k"
        >
          <p
            v-for="error in v"
            :key="error"
            class="text-sm leading-relaxed"
          >
            {{ error }}
          </p>
        </div>
      </div>
      <form>
        <div class="md:flex md:items-center mb-6">
          <div class="md:w-1/3">
            <label
              class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
              for="price_ht"
            >Quantity added</label>
          </div>
          <div class="md:w-2/3">
            <input
              id="quantity"
              class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
              type="number"
              autocomplete="quantity"
              v-model="quantity"
            />
          </div>
        </div>
        <div class="md:flex md:items-center mb-6">
          <div class="md:w-1/3">
            <label
              class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
              for="price_ht"
            >Price HT</label>
          </div>
          <div class="md:w-2/3">
            <input
              id="price_ht"
              class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
              type="number"
              autocomplete="price_ht"
              v-model="price_ht"
            />
          </div>
        </div>
        <div class="md:flex md:items-center">
          <div class="md:w-1/3"></div>
          <div class="md:w-2/3">
            <base-button @click="$modal.hide('add-stock-modal')">Cancel</base-button>
            <primary-button @click="submit">Add Stock</primary-button>
          </div>
        </div>
      </form>
    </div>
  </modal>

</template>
<script>
export default {
  props: {
    product: Object
  },
  data () {
    return {
      quantity: 0,
      price_ht: 0,
      errors: null
    }
  },
  methods: {
    submit () {
      window.axios.post(`/api/products/${this.product.id}/stock`, { quantity: this.quantity, price_ht: this.price_ht })
        .then((response) => {
          this.$notify({
            group: 'app',
            type: 'success',
            title: 'Stock added successfully.'
          })
          this.$emit('added', response.data.data)
          this.$modal.hide('add-stock-modal')
        }).catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors
          }
          this.$notify({
            group: 'app',
            type: 'error',
            title: 'An error occurred while adding stock.'
          })
        })
    }
  }
}
</script>
