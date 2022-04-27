<template>
  <div class="home">
    <viewTrucks />
  </div>
</template>

<script>
// @ is an alias to /src

import viewTrucks from "@/components/trucks.vue";

export default {
  name: "trucksView",

  components: {
    viewTrucks,
  },
};
</script>