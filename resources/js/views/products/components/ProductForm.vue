<template>
  <form class="">
    <div
      v-if="errors"
      class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg"
    >
      <div v-for="(v, k) in errors" :key="k">
        <p v-for="error in v" :key="error" class="text-sm leading-relaxed">
          {{ error }}
        </p>
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label
          class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
          for="name"
          >Name</label
        >
      </div>
      <div class="md:w-2/3">
        <input
          id="name"
          class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          type="text"
          :value="name"
          @input="$emit('update:name', $event.target.value)"
          autocomplete="name"
        />
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label
          class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
          for="description"
          >Description</label
        >
      </div>
      <div class="md:w-2/3">
        <ckeditor :editor="editor" :value="description" @input="$emit('update:description', $event)"></ckeditor>
      </div>
    </div>
    <div class="md:flex md:items-center mb-6" v-if="quantity">
      <div class="md:w-1/3">
        <label
          class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
          for="quantity"
          >Current stock</label
        >
      </div>
      <div class="md:w-2/3">
        <input
          id="quantity"
          class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          type="text"
          disabled
          :value="quantity"
        />
      </div>
    </div>
    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label
          class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
          for="price_ht"
          >Price HT</label
        >
      </div>
      <div class="md:w-2/3">
        <input
          id="price_ht"
          class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
          type="text"
          :value="price_ht"
          @input="$emit('update:price_ht', parseFloat($event.target.value))"
          autocomplete="price_ht"
        />
      </div>
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-1/3"></div>
      <div class="md:w-2/3">
        <slot name="actions"></slot>
      </div>
    </div>
  </form>
</template>
<script>
import CKEditor from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
export default {
  components: {
    ckeditor: CKEditor.component
  },
  props: {
    name: String,
    description: String,
    quantity: Number,
    price_ht: Number,
    errors: Array
  },
  data () {
    return {
      editor: ClassicEditor
    }
  }
}
</script>
