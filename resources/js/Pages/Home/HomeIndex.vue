<template>
  <div class="bg-white flex flex-col">
    <nav-bar />
    <div class="bg-gray-200 w-full">
     <presentation />
    </div>

  </div>
</template>

<script>
import NavBar from "@/Components/Home/NavBar";
import Presentation from "@/Components/Home/Presentation";
import CarriersTable from "@/Components/Home/CarriersTable";
import Description from "@/Components/Home/Description";

export default {
  components: {Presentation, NavBar, CarriersTable, Description }
};
</script>