// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Axios from 'axios'
// 将定义好好的store引入
import store from './store'
// from 后面的路径如果在moudel中无需加./
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
import 'animate.css/animate.min.css'
import '../src/assets/style.css'
import direct from './direct'
Vue.prototype.$http = Axios
// 关闭生产环境时错误提示
Vue.config.productionTip = false
Vue.use(MintUI);
// 移动端配置自适应font-sizex`
(function (doc, win) {
  var docEl
  docEl = doc.documentElement
  var resizeEvt
  resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize'
  var recalc
  recalc = function () {
    var clientWidth = docEl.clientWidth
    if (!clientWidth) return
    docEl.style.fontSize = 100 * (clientWidth / 640) + 'px'
  }

  if (!doc.addEventListener) return
  win.addEventListener(resizeEvt, recalc, false)
  doc.addEventListener('DOMContentLoaded', recalc, false)
})(document, window)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  direct,
  template: '<App/>',
  components: { App }
})
