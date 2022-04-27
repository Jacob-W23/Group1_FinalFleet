import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    auth: false,
    session: "",
    username: "",
    cache: [],
    editTruckIndex: "",
    Trucks: [],
    Maintenances: [],
    errors: [],
    addTruckToggle: false,
    editTruckToggle: false,
  },
  getters: {
  },
  mutations: {
    addTruck: function (state, payload) {
      state.Trucks.push(Object.assign({}, payload));
    },
    setAuth: function(state, payload) {
      state.auth = payload.auth;
      state.session = payload.session;
      console.log(state.auth);
      console.log(state.session);
    }
  },
  actions: {
  },
  modules: {
  }
})