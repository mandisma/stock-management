<template>
  <div
    class="leading-normal tracking-normal"
    id="main-body"
  >

    <div class="flex flex-wrap">
      <the-sidebar></the-sidebar>

      <div
        class="w-full bg-gray-100 pl-64 min-h-screen overlay"
        id="main-content"
      >
        <the-navbar></the-navbar>

        <!-- Page Heading -->
        <header class="bg-white shadow">
          <div class="py-4 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <slot name="header"></slot>
          </div>
        </header>

        <div class="p-6 mb-20">
          <main>
            <slot></slot>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TheSidebar from '@/components/TheSidebar'
import TheNavbar from '@/components/TheNavbar'

export default {
  name: 'Dashboard',
  components: {
    TheSidebar,
    TheNavbar
  }
}
</script>
