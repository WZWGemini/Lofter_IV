<template>
    <!-- 消息 动态页面 -->
    <div class='dynamic'>
        <ul class="dynamic-class">
          <li>
            <div class="user-header"><img src="../../assets/img/user_head.jpg"></div>
            <div class="li-right">
              <div class="box-top">
                <span class="user-name">啊哈哈</span>
                <span class="dynamic-event">关注了一人</span>
                <span class="create-time">1天前</span>
              </div>
              <div class="dynamic-content">
                <img src="../../assets/img/user_bg.jpg" alt="">
                <img src="../../assets/img/user_bg.jpg" alt="">
              </div>
            </div>
          </li>
        </ul>  
    </div>
</template>
<script>
    export default {
      name: 'dynamic',
      data () {
        return {
        }
      }
    }
</script>
<style scoped lang="scss">
  @import '../../assets/common.scss';

// dynamic的样式
.dynamic-class {
  li {
    float: left;
    width: 100%;
    background-color: #fff;    
    .user-header {
      width: .6rem;
      height: 0;
      padding-bottom: .6rem;
      overflow: hidden;
      border: 1px solid #fff;
      border-radius: 50%;
      display: inline-block;
      margin: .25rem .2rem .1rem;
      float: left;
      img {
        width: .6rem;
        float: left;
      }
    }
    .li-right {
      float: left;
      width: 80%;
      padding-bottom: .1rem;
      border-bottom: 1px solid #ccc;
      .box-top {
        font-size: .25rem;
        margin-top: .27rem;
        .user-name {
          color: #222;
          font-size: .3rem;
        }
        .dynamic-event {
          color: #777;
        }
        .create-time {
          color: #ccc;
          width: 100%;
          display: block;
        }
      }
      .dynamic-content {
        margin-top: .1rem;
        height: 1rem;
        float: left;
        img {
          width: 1rem;
          float: left;
          margin: 0 .1rem 0 0; 
        }
      }
    }
  }
}

</style>
