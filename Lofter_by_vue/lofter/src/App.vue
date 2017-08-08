<template>
  <div id="app">
    <router-view></router-view>
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
  html,body,#app{
    height: 100%;
  }
</style>
