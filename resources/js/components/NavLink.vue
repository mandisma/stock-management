<template>
  <router-link :to="to" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-900 rounded-lg cursor-pointer" exact-active-class="bg-gray-900">
    <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
      <slot name="svg-path"></slot>
    </svg>
    <span class="font-medium text-gray-300"><slot></slot></span>
  </router-link>
</template>

<script>
export default {
  props: ['to', 'active'],

  computed: {
    classes () {
      return this.active
        ? 'w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-900 rounded-lg cursor-pointer bg-gray-900'
        : 'w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-900 rounded-lg cursor-pointer'
    }
  }
}
</script>
