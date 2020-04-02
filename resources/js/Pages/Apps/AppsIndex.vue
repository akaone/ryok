<template>
  <dashboard-apps-layout>
    <div class="flex justify-center">
      <div class="mx-auto w-10/12 -m-24 fixed">
        <h3 class="text-white text-lg mb-2 font-thin">Liste des applications</h3>
        <div class="p-4 border bg-white rounded-sm min-h-screen">
          <input class="px-2 mb-4 rounded-sm w-4/12 h-8 bg-gray-ef" />

          <div class="flex">
            <div class="rounded mr-3 w-3/12 p-4 h-40 bg-blue-200">
              <div class="h-10 w-10 bg-white rounded-full" />
              <span>App name</span>
            </div>

            <div class="rounded mr-3 w-3/12 p-4 h-40 bg-blue-200">
              <div class="h-10 w-10 bg-white rounded-full" />
              <span>App name</span>
            </div>

            <div class="rounded mr-3 w-3/12 p-4 h-40 bg-blue-200">
              <div class="h-10 w-10 bg-white rounded-full" />
              <span>App name</span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </dashboard-apps-layout>
</template>

<script>
  import DashboardAppsLayout from "@/Shared/DashboardAppsLayout";
  export default {
    components: {DashboardAppsLayout},
    props: ['apps'],
    data() {
      return {
        form: {
          email: '',
          password: '',  
        }
      }
    },
    methods: {
      login() {
        this.$inertia.post('/login', this.form)
      }
    }
  }
</script>
