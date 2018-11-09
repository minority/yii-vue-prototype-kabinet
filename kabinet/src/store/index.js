import Vue from 'vue'
import Vuex from 'vuex'
import Sites from './sites'
import Shared from './shared'
import IncomeIndicators from './incomeIndicators'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    Sites, Shared, IncomeIndicators
  },
  state: {},
  getters: {},
  actions: {},
  mutations: {}
})
