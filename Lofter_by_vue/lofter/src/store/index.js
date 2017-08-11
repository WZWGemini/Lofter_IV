// 引入vue
import Vue from 'vue'
// 引入vuex
import Vuex from 'vuex'
Vue.use(Vuex)

const Store = new Vuex.Store({
  state: {
    uinfo: [],
    hasLogin: false
  },
  mutations: {
    setUinfo (state, info) {
      state.uinfo = info
      state.hasLogin = true
    }
  }
})
export default Store
