<template>
  <button
    class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
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
