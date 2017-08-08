<template>
  <div id="app">
    <transition name="fade" mode="out-in">
     <router-view></router-view>
    </transition>
  </div>
</template>

<script>
// export 出去就是一个Vue 实例
export default {
  // 为一个个组件命名，指定name 能得到更友好的提示信息
  name: 'app'
}
</script>

<style>
@import "assets/common.scss";

  html,body,#app{
    height: 100%;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active in below version 2.1.8 */ {
    opacity: 0
  }
</style>
