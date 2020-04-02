<template>
  <div>
    <div class="flex items-center justify-center bg-pblue px-4 py-2 w-40">
      <span class="text-xl text-white">{{country}}</span>
    </div>
    <div
      v-for="(item, index) in carriers"
      :key="item.name"
      class=" flex flex-col items-center justify-center border-r border-b border-pblue px-4 py-2"
      :class="{'bg-gray-300': index % 2 == 0,  'bg-white': index % 2 !== 0 }"
    >
      <span class="text-xl text-gray-800 font-light italic">{{item.name}}</span>
      <div class="flex">
        <div v-if="item.trade_active == true" class="w-2 h-2 bg-pblue rounded-full mx-1"></div>
        <div v-if="item.inapp_active == true"  class="w-2 h-2 bg-pyellow rounded-full mx-1"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CarriersTableRow",
  props: {
    country: {
      type: String,
      required: true,
    },
    carriers: {
      type: Array,
      required: true,
      validator: (prop) => prop.every(e =>
        typeof e.name !== 'undefined' && typeof e.trade_active  !== 'undefined' && e.inapp_active  !== 'undefined' 
      ),
    },
  }
}
</script>

<style scoped>

</style>