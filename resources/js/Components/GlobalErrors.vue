<template>
  <div v-if="$page.errors.length > 0" class="bg-red-500 text-white font-light italic rounded mx-6 my-4 p-2">
    <ul class="list-inside">
      <li v-for="error in $page.errors">
        {{ error[0] }}
      </li>
    </ul>
  </div>
</template>

<script>
    export default {
        name: "GlobalErrors"
    }
</script>