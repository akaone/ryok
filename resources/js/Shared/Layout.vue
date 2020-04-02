<template>
  <div class="flex min-h-screen bg-gray-ef">
    <div class="border-r border-gray-ef w-64 bg-pindigo-light">left</div>
    <div class="flex-grow">
      <div class="bg-white shadow-md p-4 border-b border-gray-8e">
            Navbar
        </div>
      <!-- <slot /> -->
    </div>
    
  </div>
</template>

<script>
    export default {
        name: "Layout"
    }
</script>