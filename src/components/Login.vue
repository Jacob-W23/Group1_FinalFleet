<template>
  <div>
    <form v-if="!this.auth">
      <fieldset>
        <legend>{{ legend }}</legend>
        <label>Username: <input type="text" v-model="username" /></label>
        <br />
        <label>Password: <input type="password" v-model="password" /></label>
        <br />
        <button v-on:click.prevent="login()">Login</button>
      </fieldset>
    </form>
    <form v-else>
      <fieldset>
        <button v-on:click="logout()">Logout</button>
      </fieldset>
    </form>
  </div>
</template>

<script>
import store from "@/store/index.js";
export default {
  name: "loginForm",
  props: {
    legend: {
      type: String,
      default: "Login",
    },
  },
  data: function () {
    return {
      username: "",
      password: "",
    };
  },
  computed: {
    auth: function () {
      return store.state.auth;
    },
  },
  methods: {
    login: function() {
        const formdata = new FormData();
        var vm = this;
      
        formdata.append("username",this.username);
        formdata.append("password",this.password);
      
        fetch("http://localhost/src/php/login.php", {
          method: "post",
          body: formdata
          })
          .then(response => response.json())
          .then(function(data) {
            if(data.status == "Success") {
                vm.username = "";
                vm.password = "";
            
              store.commit("setAuth", {
                    auth: data.auth,
                    session: data.session
                });
              } else {
                console.log(data);
              }
          });
    },
    logout: function () {
      store.state.auth = false;
      store.state.username = "";
    },
  },
};
</script>

<style scoped>
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}
input[type=text]:focus {
    background-color: #ddd;
    outline: none;
}
button {
    background-color: green;
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
}
* {box-sizing: border-box}
</style>