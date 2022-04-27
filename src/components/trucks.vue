<template>
  <div>
    
    <h3>Truck List</h3>
    <table class="tg">
      <thead>
        <tr>
          <th class="tg-c3ow">Dot ID</th>
          <th class="tg-c3ow">Year</th>
          <th class="tg-c3ow">Type</th>
          <th class="tg-c3ow">Make</th>
          <th class="tg-c3ow">Model</th>
          <th class="tg-c3ow">Current Mileage</th>
          <th class="tg-c3ow">Status</th>
          <th class="tg-c3ow">Last Maintenance Mileage</th>
          <th class="tg-c3ow">
            <button class="editButtonClass" v-if="!addTruckToggle && !editTruckToggle" v-on:click="addToggle">
              Add Truck
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(Truck, index) in Trucks" :key="index">
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.DOTID }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.Year }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.Type }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.Make }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.Model }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >
            {{ Truck.CurrentMileage | formatNumber }}
          </td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >{{ Truck.Status }}</td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" >
            {{ Truck.LastMaintenenceMileage | formatNumber }}
          </td>
          <td v-bind:class="{
          tge3ua: index % 2 == 1,
          tg7btt: index % 2 == 0,
        }" ><button class="editButtonClass" v-on:click.prevent="editToggle(index)" v-if="!editTruckToggle && !addTruckToggle">Edit</button>
        </td>      
        </tr>

        <tr v-if="editTruckToggle">
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }" >
            <input
              type="text"
              v-model="truckForm.DOTID"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.Year"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <select v-model="truckForm.Type">
              <option value="Full Sleeper">Full Sleeper</option>
              <option value="Single Cab">Single Cab</option>
              <option value="Single Axle">Single Axle</option>
            </select>
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input type="text" v-model="truckForm.Make" />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input type="text" v-model="truckForm.Model" />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.CurrentMileage"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <select v-model="truckForm.Status">
              <option value="In Lot">In Lot</option>
              <option value="On Road">On Road</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.LastMaintenenceMileage"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <button class="editButtonClass" type="submit" v-on:click.prevent="editForm">
          Save
        </button>
        <button class="cancelButtonClass" v-on:click.prevent="editToggle">Cancel</button>
        <button
          class="cancelButtonClass"
          v-on:click.prevent="deleteTruck()"
        >
          Delete
        </button>
          </td>
        </tr>
        
        <tr v-if="addTruckToggle">
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }" >
            <input
              type="text"
              v-model="truckForm.DOTID"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.Year"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <select v-model="truckForm.Type">
              <option value="Full Sleeper">Full Sleeper</option>
              <option value="Single Cab">Single Cab</option>
              <option value="Single Axle">Single Axle</option>
            </select>
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input type="text" v-model="truckForm.Make" />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input type="text" v-model="truckForm.Model" />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.CurrentMileage"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <select v-model="truckForm.Status">
              <option value="In Lot">In Lot</option>
              <option value="On Road">On Road</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <input
              type="text"
              v-model="truckForm.LastMaintenenceMileage"
              @keypress="validateNumber"
            />
          </td>
          <td v-bind:class="{
          tge3ua: Trucks.length % 2 == 1,
          tg7btt: Trucks.length % 2 == 0,
        }">
            <button class="editButtonClass" type="submit" v-on:click.prevent="form">Add Truck</button>
            <button class="cancelButtonClass" v-on:click.prevent="addToggle">Cancel</button>
          </td>
        </tr>
      </tbody>
    </table>
    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
    </p>
  </div>
</template>

<script>
var numeral = require("numeral");
import store from "@/store/index.js";
export default {
  name: "viewTrucks",
  components: {},
  computed: {
    Trucks: function () {
      return store.state.Trucks;
    },
    errors: function () {
      return store.state.errors;
    },
    addTruckToggle: function () {
      return store.state.addTruckToggle;
    },
    editTruckToggle: function () {
      return store.state.editTruckToggle;
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
      truckForm: {
        id: null,
        DOTID: "",
        Year: "",
        Type: "",
        Make: "",
        Model: "",
        CurrentMileage: "",
        Status: "",
        LastMaintenenceMileage: "",
      },
    };
  },
  created: function() {
    this.getTrucks();
  },
  methods: {
    getTrucks: function() {
      const formdata = new FormData();
      var vm = this;
      
      formdata.append("session", vm.session);
      fetch("http://localhost/src/php/getTrucks.php", {
        method: "post",
        body: formdata
      })
      .then(response => response.json())
      .then(function(data) {
        store.state.Trucks = data.vehicles;
        console.log(data)
      })
    },
    addTruck: function () {
            const formdata = new FormData();
            var vm = this;
            formdata.append("session", vm.session);
            formdata.append("dotID",vm.truckForm.DOTID);
            formdata.append("year",vm.truckForm.Year);
            formdata.append("type",vm.truckForm.Type);
            formdata.append("make",vm.truckForm.Make);
            formdata.append("model",vm.truckForm.Model);
            formdata.append("miles",vm.truckForm.CurrentMileage);
            formdata.append("status",vm.truckForm.Status);
            formdata.append("maintenance",vm.truckForm.LastMaintenenceMileage);
            fetch("http://localhost/src/php/addTruck.php", {
                method: "post",
                body: formdata
            })
            .then(response => response.json())
            .then(function (data) {
                if(data.outcome == "success") {
                  console.log(data);
                  vm.truckForm.DOTID = "";
                  vm.truckForm.Year = "";
                  vm.truckForm.Type = "";
                  vm.truckForm.Make = "";
                  vm.truckForm.Model = "";
                  vm.truckForm.CurrentMileage = "";
                  vm.truckForm.Status = "";
                  vm.truckForm.LastMaintenenceMileage = "";
                  //vm.$router.go(); //this will refresh page after add and show updated table but also logs user out so need better way to refresh
                } else {
                    console.log(data);
                }
            });
        },
    deleteTruck: function () {
      var vm = this;
      const formdata = new FormData();
      formdata.append("session", vm.session);
      formdata.append("dotID",store.state.Trucks[store.state.editTruckIndex].DOTID);
      fetch("http://localhost/src/php/deleteTruck.php", {
        method: "post",
        body: formdata
      })
      .then(response => response.json())
      .then(function (data) { 
        if(data.outcome == "success") {
          //vm.$router.go(); //this will refresh page after delete and show updated table but also logs user out so need better way to refresh
          console.log(data);
        } else {
          console.log(data);
        }
      });
      store.state.editTruckToggle = !store.state.editTruckToggle;
    },
    addToggle() {
      store.state.addTruckToggle = !store.state.addTruckToggle;
      store.state.errors = [];
    },
    editToggle(i) {
      store.state.editTruckToggle = !store.state.editTruckToggle;
      store.state.editTruckIndex = i;
      this.truckForm = Object.assign({}, store.state.Trucks[i]);
      store.state.errors = [];
    },
    editForm() {
      if (this.checkForm()) {
        const formdata = new FormData();
        var vm = this;
        formdata.append("session", vm.session);
        formdata.append("dotID",store.state.Trucks[store.state.editTruckIndex].DOTID);
        formdata.append("year",vm.truckForm.Year);
        formdata.append("type",vm.truckForm.Type);
        formdata.append("make",vm.truckForm.Make);
        formdata.append("model",vm.truckForm.Model);
        formdata.append("miles",vm.truckForm.CurrentMileage);
        formdata.append("status",vm.truckForm.Status);
        formdata.append("maintenance",vm.truckForm.LastMaintenenceMileage);
        fetch("http://localhost/src/php/updateTruck.php", {
          method: "post",
          body: formdata
        })
        .then(response => response.json())
        .then(function (data) { 
          if(data.outcome == "success") {
            //vm.$router.go(); //this will refresh page after update and show updated table but also logs user out so need better way to refresh
            console.log(data);
            vm.editToggle();
          } else {
            console.log(data);
          }
        });
      }
    },
    form() {
      if (this.checkForm()) {
        this.addTruck();
        store.state.addTruckToggle = !store.state.addTruckToggle;
      }
    },
    checkForm: function () {
      store.state.errors = [];
      if (
        !(
          this.truckForm.DOTID == "" ||
          this.truckForm.Year == "" ||
          this.truckForm.Type == "" ||
          this.truckForm.Make == "" ||
          this.truckForm.Model == "" ||
          this.truckForm.Status == "" ||
          this.truckForm.LastMaintenenceMileage == "" ||
          this.truckForm.CurrentMileage == "" ||
          this.truckForm.Year < 1900 ||
          this.truckForm.LastMaintenenceMileage < 0 ||
          this.truckForm.CurrentMileage < 0
        )
      ) {
        return true;
      }
      if (!this.truckForm.DOTID) {
        store.state.errors.push("DOT ID required.");
      }
      if (!this.truckForm.Year) {
        store.state.errors.push("Year required.");
      } else if (this.truckForm.Year < 1900) {
        store.state.errors.push("Year must be greater than 1900.");
      }
      if (!this.truckForm.Type) {
        store.state.errors.push("Type required.");
      }
      if (!this.truckForm.Make) {
        store.state.errors.push("Make required.");
      }
      if (!this.truckForm.Model) {
        store.state.errors.push("Model required.");
      }
      if (!this.truckForm.CurrentMileage) {
        store.state.errors.push("Miles required.");
      } else if (this.truckForm.CurrentMileage < 0) {
        store.state.errors.push("Miles must be greater than 0.");
      }
      if (!this.truckForm.Status) {
        store.state.errors.push("Status required.");
      }
      if (!this.truckForm.LastMaintenenceMileage) {
        store.state.errors.push("Last maintenance Milage required.");
      } else if (this.truckForm.LastMaintenenceMileage < 0) {
        store.state.errors.push(
          "Last maintenance Milage must be greater than 0."
        );
      }
      return false;
    },
    validateNumber: (event) => {
      let keyCode = event.keyCode;
      if (keyCode < 48 || keyCode > 57) {
        event.preventDefault();
      }
    },
  },
};
</script>