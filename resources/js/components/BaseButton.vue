<template>
  <button
    class="shadow bg-gray-400 hover:bg-gray-300 focus:shadow-outline focus:outline-none text-gray-700 font-bold py-2 px-4 rounded"
    type="button"
    @click="$emit('click', $event.target.value)"
  >
    <slot></slot>
  </button>
</template>
<script>
export default {

}
</script>
