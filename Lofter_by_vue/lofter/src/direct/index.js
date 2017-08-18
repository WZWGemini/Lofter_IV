// 将vue引入
import Vue from 'vue'
// 自定一个指令 touchmove
Vue.directive('touchmove', {
  bind: function (el) {
    var x = 0
    el.addEventListener('touchstart', (e) => {
      if (e.touches.length > 1) {
        return false
      }
      // 由于 指令绑定在.home上 所以 不能将默认的点击时间阻止
      // e.preventDefault()
      x = e.touches[0].clientX
    })
    el.addEventListener('touchmove', (e) => {
      var mx
      // console.log(e)
      mx = e.touches[0].clientX - x
      if (mx > 100) {
        document.getElementById('desert').click()
      } else if (mx < -100) {
        document.getElementById('follow').click()
      }
    })
  }
})
