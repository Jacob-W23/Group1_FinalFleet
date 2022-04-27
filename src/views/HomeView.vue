<template>
  <div class="home">
    <h2 id="home">Home</h2>

    <h3>Welcome to Megan's Fleet Truck Tracker!</h3>

    <p v-if="!auth">Login to view and update Trucks</p>
    <loginView />
  </div>
</template>

<script>
// @ is an alias to /src
import loginView from "@/views/LoginView.vue";
import store from "@/store/index.js";
export default {
  name: "HomeView",
  components: {
    loginView,
  },
  computed: {
    auth: function () {
      return store.state.auth;
    },
  },
};
</script>
