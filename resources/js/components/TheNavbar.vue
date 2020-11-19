<template>
  <div class="sticky top-0 z-40">
    <div
      class="w-full h-16 px-6 bg-gray-800 border-b border-gray-900 flex items-center justify-between"
    >
      <!-- left navbar -->
      <div class="flex">
        <!-- mobile hamburger -->
        <div class="lg:hidden flex items-center mr-4">
          <button
            class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger"
          >
            <svg
              class="h-5 w-5"
              v-bind:style="{ fill: 'black' }"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- right navbar -->
      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative">
          <dropdown align="right" width="48">
            <template #trigger>

              <button
                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
              >
                <div>{{username()}}</div>

                <div class="ml-1">
                  <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </div>
              </button>
            </template>

            <template #content>
              <!-- Authentication -->
              <form @submit.prevent="logout">
                <dropdown-link as="button"> Logout </dropdown-link>
              </form>
            </template>
          </dropdown>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  methods: {
    username () {
      return JSON.parse(localStorage.getItem('user')).name
    },
    logout () {
      window.axios.post('/api/auth/logout').then((response) => {
        localStorage.removeItem('user')
        this.$router.push('/login')
      })
    }
  }
}
</script>
