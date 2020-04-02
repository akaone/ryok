<template>
  <div class="bg-white border-b w-full sticky top-0">
    <div class="container py-4 flex flex-col md:flex-row md:items-center mx-4 md:mx-auto">
      <div class="w-1/6">
        <h3 class="font-ryok text-pblue text-2xl">Ryok</h3>
      </div>
      <div class="w-4/6 hidden md:block">
        <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Opérateurs</a>
        <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Fonctionnalités</a>
        <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Developpeurs & Entreprises</a>
        <a href="#" class="font-light hover:underline hover:text-pblue text-sm mr-3">Faq</a>
      </div>
      <div class="w-1/6 hidden md:flex justify-end">
        <inertia-link :href="route('login')" class="font-medium text-white text-xs bg-pblue px-4 py-2 rounded-full shadow hover:shadow-lg">
          Accés marchand
        </inertia-link>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: "NavBar"
    }
</script>

<style scoped>

</style>