<template>
  <!-- 添加关注 页面 -->
  <div class="animated slideInRight addFollow">
    <!--解决顶部导航栏挡住内容问题  -->
    <div class="add-top">
    </div>
    <!-- 顶部固定导航栏 -->
    <mt-header fixed class="top-nav" title="添加关注">
      <router-link to="/lofter/home/follow" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    
    <!-- 内容盒子 -->
    <div class="content">

      <!-- 关注内容盒子 -->
      <div class="follow-list">
        <div class="follow-box" v-for="box in 5">
            <div class="user-info">
              <div class="user-head"><img src="../../assets/img/user_head.jpg"></div>              
              <div class="user-left">
                <span class="user-name">啊哈哈</span>
                <span class="user-like">被喜欢
                    <span class="user-like-d">3158</span>
                次</span>
              </div>
              <div class="user-right">
                  <router-link to="" class="btn-follow">关 注</router-link>
              </div>
            </div>
            <div class="user-album">
              <img src="../../assets/img/user_bg.jpg" v-for="item in 6">
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'addFollow',

  data () {
    return {
    }
  },
  methods: {

  }

}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../../assets/common.scss';
  /* CSS Document */

  .addFollow, .follow-list {
    background-color: #efefef;
    font-size: .3rem;   
  }

  // 顶部固定导航栏
  .top-nav{
    color: $topic_color;
    background-color: #fff;
    font-size: .3rem;
    height: .8rem;
    position: fixed;
  }
  .add-top {
    height: .8rem;
  }
  .content {
    width: 100%;
  }

  .follow-box {
    margin: .2rem 0 .1rem;
    background-color: #fff;
    font-size: .2rem;  
    display: inline-block;
    width: 100%;
    .user-info {
      width: 100%;
      display: inline-block;   
      .user-head {
        width: .8rem;
        height: 0;
        padding-bottom: .8rem;
        overflow: hidden;
        border: 1px solid #fff;
        border-radius: 50%;
        display: inline-block;
        float: left;
        margin: .15rem .2rem 0;
        img{
          width: .8rem;
          float: left;
        }
      }
      .user-left {
        width: 20%;
        float: left;
        .user-name {
          font-size: .3rem;
          display: inline-block;
          float: left;
          padding-top: .25rem;    
        }
        .user-like {
          font-size: .2rem;
          display: inline-block;
          float: left;
          color: #777;
        }
      }
      .user-right {
        float: right;
        font-size: .25rem;
        padding-top: .4rem;
        .btn-follow {
          color: red;
          border-radius: .3rem;
          border: 1px solid red;
          padding: .1rem .2rem;
          margin-right: .35rem;
        }
      }
    }

    .user-album {
      width: 100%;
      // clear: both;
      display: inline-block;
      img {
        width: 32%;
        float: left;
        margin: .03rem 0 0 .03rem;
      }
    }
  }
  
</style>
