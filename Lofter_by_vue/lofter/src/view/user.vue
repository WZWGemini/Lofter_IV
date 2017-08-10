<template>
  <!-- 个人页面 -->
  <div class="user">

    <!-- 顶部固定导航栏 -->
    <mt-header fixed class="top-nav" title="啊哈哈" label="ID:Ayu1948">
      <router-link to="/" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
      <mt-button icon="more" slot="right"></mt-button>
    </mt-header>
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 头部信息盒子 -->
      <div class="heading">

          <!-- 头部背景盒子 -->
          <div class="heading-bg">
            <img src="../assets/img/user_bg.jpg" alt="">
          </div>
          <!-- 头部用户信息栏 -->
          <div class="heading-info">
              <div class="heading-user"></div>
              <p class="heading-username">啊哈哈</p>

              <!-- 头部功能栏 -->
              <div class="heading-function">
                <router-link to="/" active-class="a-class">关注</router-link>
                <router-link to="/" active-class="a-class">粉丝</router-link>
                <router-link to="/" active-class="a-class">喜欢</router-link>
              </div>
          </div>
      </div>

      <!-- 博文内容盒子 -->
      <div class="blog-list">
        <mt-cell title="3篇文章">
          <mt-cell icon="more"></mt-cell>
        </mt-cell>
        <div class="blog-box">
          <div class="blog-top">
            <div class="user-header"><img src="../assets/img/user_head.jpg"></div>
            <span class="user-name">啊哈哈</span>
            <span class="create-time">1天前</span>
          </div>

          <!-- 文章内容 -->
          <div class="blog-article clear">
            <h4 class="article-title">标题</h4>
            <div class="article-content">内容</div>
          </div>

          <router-link to="/user" active-class="show-article">显示全文</router-link>
          <!-- 标签盒子 -->
          <div class="tag-box">
            <ul>
              <li class="tag-li-a">#</li>
              <li class="tag-li"><router-link to="/" active-class="li-class">标签</router-link></li>
              <li class="tag-li"><router-link to="/" active-class="li-class">测试</router-link></li>
              <li class="tag-li"><router-link to="/" active-class="li-class">样式</router-link></li>
            </ul>
          </div>

          <!-- 功能按钮 -->
          <div class="btn-box">
            <ul>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-heart"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-bubble2"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-redo2"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-like"></span></router-link></li>
            </ul>
            
          </div>
        </div>

        <div class="blog-box">
          <div class="blog-top">
            <div class="user-header"><img src="../assets/img/user_head.jpg"></div> 
            <span class="user-name">啊哈哈</span>
            <span class="create-time">1天前</span>
          </div>

          <!-- 文章内容 -->
          <div class="blog-article clear">
            <h4 class="article-title">标题</h4>
            <div class="article-content">内容</div>
          </div>

          <router-link to="/user" active-class="show-article">显示全文</router-link>
          <!-- 标签盒子 -->
          <div class="tag-box">
            <ul>
              <li class="tag-li-a">#</li>
              <li class="tag-li"><router-link to="/" active-class="li-class">标签</router-link></li>
              <li class="tag-li"><router-link to="/" active-class="li-class">测试</router-link></li>
              <li class="tag-li"><router-link to="/" active-class="li-class">样式</router-link></li>
            </ul>
          </div>

          <!-- 功能按钮 -->
          <div class="btn-box">
            <ul>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-heart"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-bubble2"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-redo2"></span></router-link></li>
              <li class="btn-li"><router-link to="/" active-class="li-class"><span class="icon-like"></span></router-link></li>
            </ul>
          </div>

          <!-- 交互列表：评论和阅读情况 -->
          <div class="mutual-list">
            <div class="mutual-top">
              <span class="comment-count">1条评论</span>
              <span class="read-count">147次阅读</span>
            </div>
            <ul class="comment-list">
              <li>
                <span class="comment-user">测试</span>
                <span class="comment-colon">:</span>
                <span class="comment-content">哈哈哈</span>
              </li>
              <li>
                <span class="comment-user">测试</span>
                <span class="comment-colon">:</span>
                <span class="comment-content">哈哈哈</span>
              </li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'user',
  data () {
    return {

    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../assets/common.scss';
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
  }

  .heading-bg img {
    width: 100%;
    /* height: 35%; */
    overflow: hidden;
    position: absolute;
    z-index: -1;
    top: -1rem;
  }

  .heading-info {
    background: #FFF;
    height: 2rem;
  }

  .heading-user {
    background: url("../assets/img/user_head.jpg");
    width: 1.8rem;
    height: 1.8rem;
    background-position: center;
    background-size: cover;
    border-radius: 50%;
    position: absolute;
    top: 2rem;
    margin-left:35%;
    border: 3px solid #fff;
  }

  .heading-username {
    font-family:'STXinwei', sans-serif;
    display:block;
    text-align:center;
    padding-top: 1rem;
    font-size: 0.4rem;
  }

  .heading-function {
    display:block;
    text-align:center;
    font-size: .25rem;
    margin-top: .1rem;
  }

  // 博文内容盒子
  .blog-list {
    background-color: #eee;
  }

  .mint-cell{
    background-color: #eee;
  }
  
  .blog-box {
    // height: 4rem;
    background-color: #fff;
    margin-bottom: 0.3rem;
  }

  .blog-top {
    padding-top: .15rem;
    margin-bottom: .15rem;
    background-color: #fff;
    color: #999;
    font-size: .25rem;
  }
  .user-header {
    width: .6rem;
    height: 0;
    padding-bottom: .6rem;
    overflow: hidden;
    border: 1px solid #fff;
    border-radius: 50%;
    display: inline-block;
    float: left;
    margin: .1rem .2rem;
  }
  .user-header img {
    width: .6rem;
  }
  .user-name {
    float: left;
    color: #111;
    margin: .25rem 0 0 .1rem;
  }
  .create-time {
    float: right;
    margin: .25rem .2rem 0 0;
  }

  // 文章内容
  .blog-article {
    padding: .1rem .2rem;
    margin-bottom: .2rem;
  }
  .article-title {
    margin: 0 0 .2rem;
    font-size: .35rem;
  }
  .article-content {
    font-size: .25rem;
  }
  .show-article {
    color: #777;
    font-size: .2rem;
    margin: .2rem;
    padding: .18rem;
    border: 1px solid #777;
    border-radius: .4rem;
  }
  .tag-box ul {
    padding: 0;
    margin: .3rem .3rem .2rem;
    height: .5rem;
    border-bottom: 1px dotted #999;
  }
  .btn-box ul {
    padding: 0;
    margin: .2rem .3rem;
    margin-bottom: 0;
    font-size: .3rem;
    height: .5rem;
  }
  .tag-box ul li, .btn-box ul li {
    float: left;
    font-size: .25rem;
  }
  .li-class {
    color: #999;
  }
  .tag-box ul .tag-li-a {
    color: #888;
    font-weight: 900;
  }
  .tag-box ul .tag-li, .btn-box ul li {
    width: .8rem;
    text-align: center;
  }

  // 交互列表
  .mutual-top {
    padding: 0;
    margin: 0 .3rem;
    color: #777;
    font-size: .25rem;
      .read-count {
      float: right;
    }
  }
  .comment-list {
    padding: 0;
    font-size: .25rem;
    margin: 0 .3rem;
    li {
      margin: .1rem 0;
      font-size: .25rem;
      .comment-user {
        color: $topic_color;
        font-family:'STFangsong', sans-serif;
        font-weight: 600;
      }
      .comment-content, li .comment-colon {
        color: #777;
        font-size: .23rem;
      }
    }
  }
</style>
