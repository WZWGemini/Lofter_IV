<template>
  <!-- 个人页面 -->
  <div class="personal">
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 头部信息盒子 -->
      <div class="heading">

          <!-- 头部背景盒子 -->
          <div class="heading-bg">
            <img src="../../assets/img/user_bg.jpg" alt="">
          </div>
          <!-- 头部用户信息栏 -->
          <div class="heading-info">
              <div class="heading-user">
                  <img src="../../assets/img/user_head.jpg" alt="">
              </div>
              <div class="heading-right">
                <span class="heading-username">啊哈哈</span>
                <span class="user-id">ahaha1948</span>
                <!-- 头部功能栏 -->
                <div class="heading-function">
                  <router-link to="/" active-class="a-class">关注</router-link>
                  <router-link to="/" active-class="a-class">粉丝</router-link>
                  <router-link to="/" active-class="a-class">喜欢</router-link>
                </div>
              </div>
              

              
          </div>
      </div>
      <!-- 功能盒子 -->
      <div class="function-box">
        <ul class="news-class">
          <li>
            <span class="icon-user-plus2 icon"></span>
            <mt-cell class="cell-class" title="新的粉丝" icon="" is-link to="/"></mt-cell>
          </li>  
          <li>
            <span class="icon-heart2 icon"></span>
            <mt-cell class="cell-class" title="喜欢" icon="" is-link to="/"></mt-cell>
          </li>
          <li>
            <span class="icon-bubble2 icon"></span>
            <mt-cell class="cell-class" title="评论" icon="" is-link to="/"></mt-cell>
          </li>
          <li>
            <span class="icon-sound icon"></span>
            <mt-cell class="cell-class" title="通知" icon="" is-link to="/"></mt-cell>
          </li>
        </ul>
      </div>
    </div>

    
  </div>
</template>

<script>
// 单独引入 辅助函数

export default {
  name: 'personal',
  created () {

  },
  components: {

  },
  data () {
    return {

    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../../assets/common.scss';
  /* CSS Document */

  // 顶部固定导航栏
  .top-nav{
    color: $topic_color;
    background-color: #fff;
    // opacity:0;
    font-size: .3rem;
    height: 7%;
  }

  // 头部信息盒子
  .heading-bg {
    width:100%;
    height: 3rem;
    overflow: hidden;
    position: absolute;
  }

  .heading-bg img {
    width: 100%;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    top: -1rem;
    opacity: .5;
  }

  .heading-user {
    width: 1.2rem;
    height:0;
    padding-bottom: 1.2rem;
    overflow: hidden;
    border-radius: 50%;
    position: absolute;
    top: 1rem;
    margin-left:7%;
    border: 3px solid #fff;
    img {
        width: 1.2rem;
    }
  }

  .heading-right {
    display: inline-block;
    margin: 1rem 0 0 2rem;
    font-size: 0.4rem;    
    .heading-username {
      font-family:'STXinwei', sans-serif;
      display:block;
    }
    .user-id {
      font-size: 0.25rem;
      color: #777;
      
    }
    .heading-function {
      display:block;
      text-align:center;
      font-size: .25rem;
      margin-top: .2rem;
    }
  } 
  
.news-class {
  width: 100%;
  float: left;
  background-color: #fff;  
  margin-bottom: .5rem;
  li {
    width: 100%;
    float: left;
    height: .9rem;
    background-color: #fff;
    .icon {
      color: #bbb;
      float: left;
      padding: .2rem 0 0 .3rem;
      font-size: .5rem;
    }
    .cell-class {
      width: 85%;
      height: .9rem;
      float: right;
      border: none;
    }
  }
}
  

  

</style>
