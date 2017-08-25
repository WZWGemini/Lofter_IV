<template>
    <div class="discover">
        <!-- 顶部固定导航栏 -->
        <header class="header">
            <nav class="navbar">
            <div class="navbar-wp">
                <!-- <router-link to="" class="top-icon icon active">
                <span class="icon-search"></span>
                </router-link>  -->
                <div class="top-nav">
                  <div class="clear topnav-class">
                    <router-link to="/lofter/discover/all" class="li-class" active-class="a-li">全部</router-link>
                    <router-link to="/lofter/discover/sport" class="li-class" active-class="a-li">运动</router-link>
                    <router-link to="/lofter/discover/foot" class="li-class" active-class="a-li">美食</router-link>
                    <router-link to="/lofter/discover/shoot" class="li-class" active-class="a-li">摄影</router-link>
                    <router-link to="/lofter/discover/movie" class="li-class" active-class="a-li">电影</router-link>
                    <router-link to="/lofter/discover/trip" class="li-class" active-class="a-li">旅行</router-link>
                    <router-link to="/lofter/discover/music" class="li-class" active-class="a-li">音乐</router-link>
                  </div>
                </div>
            </div>  
            </nav> 
        </header> 
        <transition name="slide-fade" model="out-in"s>
            <router-view>
                
            </router-view>  
        </transition>
    </div>
</template>
<script>
    
</script>
<style lang="scss" scoped>
  @import '../assets/common.scss';
  .header {
    .navbar {
      width: 100%;
      position: fixed;
      top: 0;
      background-color: #fff;
      height: .8rem;
      line-height: .8rem;
      font-size: .35rem;
      border-bottom: 1px solid #efefef;
      z-index: 999;
      text-align: center;
      .navbar-wp {
        width: 100%;
        position: relative;
        height: .8rem;
        margin: 0 .2rem 0 0;
        .top-icon {
          position: relative;
          display: inline-block;
          height: 100%;
          span {
            color: $topic_color;
            padding: .25rem .2rem 0;
            float: left;
          }
        }
        .active {
          position: absolute;
          top: 0;
          width: .8rem;
          left: -.8rem;
        }
        .icon:after {
          content: "";
          position: absolute;
          right: -.5rem;
          top: 0;
          bottom: 0;
          width: .5rem;
          background-image: radial-gradient(ellipse at left, rgba(0, 0, 0, 0.1) 0, rgba(0, 0, 0, 0) 80%);
        }
        .top-nav {
          overflow: hidden;
          z-index: 2;
          .clear:after {
            content: "";
            display: table;
            clear: both;
          }
          .topnav-class {
            white-space: nowrap;
            height: 100%;
            overflow-y: hidden;
            .li-class {
              padding: .18rem .25rem;
              color: $topic_color;
            }
            .a-li {
              border-bottom: 2px solid $topic_color;
            }
          }
        }
      }
    }
  }
  // 过度动画
  .slide-fade-enter-active {
    transition: all .3s ease;
  }
  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .slide-fade-enter, .slide-fade-leave-to
  /* .slide-fade-leave-active for below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
  }
</style>