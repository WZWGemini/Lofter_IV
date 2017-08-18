// 引入vue
import Vue from 'vue'
// 引入vuex
import Vuex from 'vuex'
Vue.use(Vuex)

const Store = new Vuex.Store({
  state: {
    // 用于存储用户信息 ： user_name user_id user_head
    uinfo: [],
    // 用于判断是否已经登录
    hasLogin: false,
    // 用于存储 点击其他用户个人页面文章
    orderArticle: [],
    oArticleNum: 0, // 该用户文章总数
    totalOrdArtNum: 0, // 已加载文章总数
    oLastPage: '', // 该用户TP5返回文章最后一页
    oCurPage: 0, // 需要下次下拉刷新加载页
    // 用于存储已登录用户个人界面文章
    uarticle: [],
    uArticleNum: 0, // 用户文章总数
    totalArtNum: '', // 用于存储已在store中存储了的文章数量
    uLastPage: '', // 用户文章最后一页
    uCurPage: 0, // 用户文章下次加载页
    // 所有已加载文章
    allArticle: [],
    allLastPage: '', // 所有文章最后一页
    allArticleNum: 0, // 所有文章总数
    totalAllArtNum: 0, // 已加载文章数量
    allCurPage: 0, // 用户文章下次加载页
    // 目前点击需要显示的评论
    curComment: '',
    curArtId: '',
    curArticleIndex: '',
    // 存储用户标签
    tag: [],
    tagArticleInfo: []
  },
  mutations: {
    // 设置用户信息
    setUinfo (state, info) {
      state.uinfo = info
      state.hasLogin = true
    },
    // 将uarticle 置空
    // unsetUarticle(){

    // },
    // 设置用户个人界面文章
    setUarticle (state, article) {
      // 使用push方法将 新添加的article添加到 uarticle
      // 例如 uarticle=[1,2] article=[3,4]，使用下述方法后，会变成[1,2,3,4]
      console.log(article)
      state.uarticle.push(...article.data)
      state.totalArtNum = state.uarticle.length
      state.uArticleNum = article.total
      state.uLastPage = article.last_page
      state.uCurPage = Number(article.current_page) + 1
      console.log(state.uCurPage)
    },
    // 设置目前点击微博的评论到评论页面
    setCurComment (state, comment) {
      state.curComment = comment
      console.log(state.curComment)
    },
    // 设置所有用户文章
    setAllArticle (state, article) {
      // 使用push方法将 新添加的article添加到 uarticle
      // 例如 uarticle=[1,2] article=[3,4]，使用下述方法后，会变成[1,2,3,4]
      state.allArticle.push(...article.data)
      // console.log(state.allArticle)
      state.totalAllArtNum = state.allArticle.length
      // console.log(state.totalAllArtNum)
      state.allLastPage = article.last_page
      state.allCurPage = Number(article.current_page) + 1
      state.allArticleNum = article.total
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
    },
    // 保存同标签文章
    tagArticleSave (state, value) {
      if (state.tagArticleInfo !== []) {
        state.tagArticleInfo = []
        state.tagArticleInfo.push(value)
        console.log(state.tagArticleInfo)
      }
    }
  }
})
export default Store
