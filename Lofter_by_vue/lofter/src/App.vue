<template>
  <div id="app">
    <transition name="fade" mode="out-in">
      <!-- {{showIndexLater}}   -->
     <router-view></router-view>
    </transition>
  </div>
</template>

<script>
// export 出去就是一个Vue 实例
export default {
  // 为一个个组件命名，指定name 能得到更友好的提示信息
  name: 'app',
  data () {
    return {
    }
  },
  computed: {
  }
}
</script>

<style lang="scss">
@import "assets/common.scss";

  html,body,#app{
    height: 100%;
    margin: 0;
  }
  ul,dl{
    padding:0;
    margin: 0;
    font-family:'STKaiti', sans-serif;
  }
  a, ul, li {
    text-decoration:none;list-style:none;
  }
  .clear {
    clear: both;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active in below version 2.1.8 */ {
    opacity: 0
  }
  .a-class {
    font-family:'STFangsong', sans-serif;
    font-weight: 600;
    font-size: .25rem;
    margin-right: .2rem;
    color: #555;
    text-align:center;
  }
  a:focus, a:hover {
    color: $topic_color;
    text-decoration:none;
  }
</style>
