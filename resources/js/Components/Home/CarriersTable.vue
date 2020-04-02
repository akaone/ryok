<template>
  <div class="container px-4 mx-auto flex flex-col items-center pb-12">
    <div class="w-9/12 flex flex-col text-center my-8">
      <span class="font-lato italic text-3xl">
        Nous supportons une variété d’opérateurs et travaillons á l’ajout de tous les opérateurs existants á travers toute l’Afrique
      </span>
      <span class="text-pblue font-bold italic">
        <span class="font-ryok not-italic text-xl">Ryok</span> est actuellement disponible dans les pays suivant
      </span>
    </div>

    <div class="flex w-full justify-center items-center ">
      <button class="bg-white w-10 h-10 rounded-full shadow-lg border">-</button>
      <div class="border border-pblue shadow rounded-sm mx-4 todow-7/12 flex overflow-x-scroll bg-gray-100">
        <carriers-table-row
          country="Côte d'Ivoire"
          :carriers='[
            {name: "Orange", trade_active: true, inapp_active: true},
            {name: "MTN", trade_active: false, inapp_active: true},
          ]'
        />
        <carriers-table-row
          country="Togo"
          :carriers='[
            {name: "Togocel", trade_active: true, inapp_active: true},
            {name: "Moov", trade_active: true, inapp_active: true},
          ]'
        />
        <carriers-table-row
          country="Bénin"
          :carriers='[
            {name: "MTN", trade_active: true, inapp_active: true},
            {name: "Moov", trade_active: true, inapp_active: true},
          ]'
        />
      </div>

      <button class="bg-white w-10 h-10 rounded-full shadow-lg border">+</button>
    </div>
    <div class="flex font-light text-sm italic mt-4">
      <div class="flex items-center mr-4">
        <div class="w-2 h-2 bg-pblue rounded-full mx-1"></div>
        Paiement electronique
      </div>
      <div class="flex items-center">
        <div class="w-2 h-2 bg-pyellow rounded-full mx-1"></div>
        Transactions mobile money
      </div>
    </div>
  </div>
</template>

<script>
import CarriersTableRow from "@/Components/Home/CarriersTableRow";
  export default {
    name: "CarriersTable",
    components: {CarriersTableRow}
    
  }
</script>

<style scoped>

</style>