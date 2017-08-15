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
    hasLogin: false,
    // 用于存储已登录用户个人界面文章
    uarticle: [],
    // 用于存储文章数量
    totalArtNum: '',
    // 存储用户标签
    tag: []
  },
  mutations: {
    // 设置用户信息
    setUinfo (state, info) {
      state.uinfo = info
      state.hasLogin = true
    },
    // 设置用户个人界面文章
    setUarticle (state, article) {
      // 使用push方法将 新添加的article添加到 uarticle
      // 例如 uarticle=[1,2] article=[3,4]，使用下述方法后，会变成[1,2,3,4]
      state.uarticle.push(...article)
      state.totalArtNum = state.uarticle.length
    },
    // 保存标签
    tagSave (state, value) {
      if (state.tag.indexOf(value) === -1) {
        state.tag.push(value)
      }
    },
    // 删除上一个标签
    tagRemove (state) {
      if (state.tag !== []) {
        state.tag.splice(-1, 1)
      }
    },
    // 清空标签
    tagClear (state) {
      state.tag = []
    }
  }
})
export default Store
