<template>
  <div>
    
    <h3>Maintenance Reports</h3>
    <h3>Filter: <input type="date" v-model="maintForm.Date" /><button class="editButtonClass" v-on:click="filterList">Filter</button></h3>
    <table class="tg">
      <thead>
        <tr>
          <th class="tg-c3ow">Dot ID</th>
          <th class="tg-c3ow">CheckIn</th>
          <th class="tg-c3ow">CheckOut</th>
          <th class="tg-c3ow">Vehicle Mileage</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(Maintenance, index) in Maintenance" :key="index">
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Maintenance.DOTID }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Maintenance.CheckIn }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Maintenance.CheckOut }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Maintenance.VehicleMileage }}</td>    
        </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
var numeral = require("numeral");
import store from "@/store/index.js";
export default {
  name: "viewMaintenances",
  components: {},
  computed: {
    Maintenance: function () {
      return store.state.Maintenances;
    },
    session: function() {
      return store.state.session;
    }
  },
  filters: {
    formatNumber: function (value) {
      return numeral(value).format("0,0");
    },
  },
  data: function () {
    return {
        maintForm: {
            Date: "",
      },
    };
  },
  created: function() {
    this.getMaintenances();
  },
  methods: {
    getMaintenances: function() {
      const formdata = new FormData();
      var vm = this;
      
      formdata.append("session", vm.session);
      fetch("http://localhost/src/php/getMaintenance.php", {
        method: "post",
        body: formdata
      })
      .then(response => response.json())
      .then(function(data) {
        store.state.Maintenances = data.maintenances;
        console.log(data)
      })
    },
    filterList() {
        const formdata = new FormData();
        var vm = this;
      
        formdata.append("session", vm.session);
        formdata.append("date", vm.maintForm.Date);

        console.log(vm.maintForm.Date);

        fetch("http://localhost/src/php/getDatedMaintenance.php", {
        method: "post",
        body: formdata
      })
      .then(response => response.json())
      .then(function(data) {
        store.state.Maintenances = data.maintenances;
        console.log(data)
      })
    },
  },
};
</script>