<template>
  <div class="home">
    <viewMaintenance />
  </div>
</template>

<script>
import viewMaintenance from "@/components/Maintenance.vue";

export default {
  name: "maintenanceView",

  components: {
    viewMaintenance,
  },
};
</script>