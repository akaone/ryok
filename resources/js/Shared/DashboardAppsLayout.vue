<template>
  <div class="flex flex-col items-center min-h-screen bg-gray-ef">
    <div class="bg-white sticky top-0 w-full">
      <div class="px-12 pt-4 mx-auto flex items-center bg-pblue py-2">
        <div class="flex-grow">
          <h3 class="font-ryok text-white text-xl">Ryok</h3>
        </div>
        <div>
          <div class="w-10 h-10 flex items-center justify-center rounded-full bg-white cursor-pointer">
            <span class="text-sm">DK</span>
          </div>
        </div>
      </div>
      <div class="h-32 bg-pblue"></div>
    </div>
    <slot />
  </div>
</template>

<script>
    export default {
        name: "DashboardAppsLayout"
    }
</script>