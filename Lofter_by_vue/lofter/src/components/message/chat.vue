<template>
  <!-- 消息 聊天页面 -->
  <div class='news'>
    <div class="user-chatlist">
      <ul>
        <li>
          <div class="chat-header"><img src="../../assets/img/user_head.jpg"></div>
          <div class="li-right">
            <div class="box-top">
              <span class="chat-user">啊哈哈</span>
              <span class="chat-time">2016-12-08</span>
            </div>
            <span class="chat-content">想让作品签约网易？想让作品上架出版？哈哈哈</span>
          </div>
        </li>
        <li>
          <div class="chat-header"><img src="../../assets/img/user_head.jpg"></div>
          <div class="li-right">
            <div class="box-top">
              <span class="chat-user">啊哈哈</span>
              <span class="chat-time">2016-12-08</span>
            </div>
            <span class="chat-content">想让作品签约网易？想让作品上架出版？哈哈哈</span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
    export default {
      name: 'news',
      data () {
        return {
        }
      }
    }
</script>
<style scoped lang="scss">
  @import '../../assets/common.scss';

// chat 的样式
.user-chatlist {
  ul {
    float: left;
    background-color: #fff;
    width: 100%;
    li {
      float: left;
      width: 100%;
      .chat-header {
        width: .75rem;
        height: 0;
        padding-bottom: .75rem;
        overflow: hidden;
        border: 1px solid #fff;
        border-radius: 50%;
        display: inline-block;
        margin: .25rem .15rem .1rem;
        float: left;
        img {
          width: .75rem;
          float: left;
        }
      }
      .li-right {
        float: left;
        width: 80%;
        padding-bottom: .1rem;
        border-bottom: 1px solid #ccc;
        .box-top {
          font-size: .27rem;
          margin-top: .27rem;
          .chat-user {
            color: #222;
            font-size: .35rem;
          }
          .chat-time {
            color: #ccc;
            float: right;
          }
        }
        .chat-content {
          width: 100%;
          margin-top: .1rem;
          float: left;
          font-size: .3rem;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis; 
        }
      }
    }
  }
}

</style>
