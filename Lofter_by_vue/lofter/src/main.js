// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
// import { Swipe, SwipeItem } from 'mint-ui'
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
import 'animate.css/animate.min.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import '../src/assets/style.css'
// 关闭生产环境时错误提示
Vue.config.productionTip = false
Vue.use(MintUI);
// Vue.component(Swipe.name, Swipe)
// Vue.component(SwipeItem.name, SwipeItem);
// 移动端配置自适应font-size
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
  template: '<App/>',
  components: { App }
})
