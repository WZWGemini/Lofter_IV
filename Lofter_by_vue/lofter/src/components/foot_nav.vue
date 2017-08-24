<template>
    <!--公共底部  -->
    <div class='foot-nav'>
        <ul>
            <li>
                <router-link to='/lofter/home/follow'>
                    <span class='icon-home'></span>
                    <p>首页</p>
                </router-link>  
            </li>
            <li>
                <router-link to='/lofter/discover'>
                    <span class='icon-earth'></span>
                    <p>发现</p>
                </router-link> 
            </li>
            <li class="camera">
                 <router-link :to='url' @click.native="handleClick">
                    <span class='icon-camera'></span>
                </router-link> 
                <mt-popup v-model="popupVisible" position="bottom" class="issue">
                    <div>
                      <router-link to="" class="issue-box">
                        <span class="icon-image issue-icon"></span>
                        <span class="issue-text">图片</span>
                      </router-link>
                      <router-link to="" class="issue-box">
                        <span class="icon-play issue-icon"></span>
                        <span class="issue-text">视频</span>
                      </router-link>
                      <router-link to="/lofter/issue/text" class="issue-box">
                        <span class="icon-pencil issue-icon"></span>
                        <span class="issue-text">文字</span>
                      </router-link>
                      <router-link to="" class="issue-box">
                        <span class="icon-music issue-icon"></span>
                        <span class="issue-text">音乐</span>
                      </router-link>
                    </div>
                </mt-popup>
            </li>
            <li>
                <router-link to='/lofter/message'>
                    <span class='icon-bell'></span>
                    <p>消息</p>
                </router-link>
            </li>
            <li>
                <router-link to='/lofter/mine'>
                    <span class='icon-user'></span>
                    <p>我的</p>
                </router-link>
            </li>
        </ul>  
    </div>
</template>
<script>
    import {mapState} from 'vuex'
    export default {
      name: 'foot_nav',
      data () {
        return {
          popupVisible: false,
          url: ''
        }
      },
      computed: {
        ...mapState(['hasLogin'])
      },
      methods: {
        handleClick: function () {
          if (this.hasLogin) {
            this.popupVisible = true
          } else {
            this.url = '/login'
          }
        }
      }
    }
</script>
<style scoped lang="scss">
  @import '../assets/common.scss';

.foot-nav{
    background-color: #fff;
    font-size:0.58rem;
    width: 100%;
    padding:4px 0;
    position:fixed;
    bottom:0;
}
.foot-nav ul{
    padding: 0;
    margin:0;
    overflow:hidden;
}

.foot-nav a{
    text-decoration: none;
}
.foot-nav li{
    font-size:0.35rem;
    text-align:center;
    list-style:none;
    float:left;
    width:20%;
    padding-top: .1rem;
}
.camera{
    height: .78rem;
}
.camera a{
    display:inline-block;
    border-radius:50%; 
    width: .75rem;
    height: .75rem;
}
.camera a span{
    display: inline-block;
}
.icon-camera {
    padding: .13rem;
    border-radius: 50%;
    border: .03rem solid $topic_hcolor;
}
.foot-nav li p{
    font-size:0.25rem;
    margin:0;
    color: $topic_hcolor;
}

.foot-nav li span{
    color: $topic_hcolor;
}

// 发布弹出框
.issue {
  width: 100%;
  // height: 50%;
  .issue-box {
    width: 50%;
    height: 50%;
    float: left;
    // margin-bottom: .4rem;
    padding: .4rem 0;
    border-radius: 0;
    .issue-icon {
      width: 100%;
      // color: #fff;
      font-size: 1rem;
      color: $topic_hcolor;
    }
    .issue-text {
      padding: .03rem .35rem;
      margin-top: .08rem; 
      background-color: #efefef;
      border-radius: .2rem;
    }
  }
  .issue-box:hover ,.issue-box:focus {
    background-color: #efefef;
  }
}

</style>