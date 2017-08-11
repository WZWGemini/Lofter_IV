// 引入vue
import Vue from 'vue'
// 引入vuex
import Vuex from 'vuex'
Vue.use(Vuex)

const Store = new Vuex.Store({
  state: {
    // 用于存储用户信息 ： 用户名 id 头像路径
    uinfo: [],
    // 用于判断是否已经登录
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
