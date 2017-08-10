<template>
  <!-- 消息 消息页面 -->
  <div class='news'>
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
    <div class="line"><span>专题</span></div>
    <div class="seminar-box">
      <div class="first">
        <div class="first-left"><img src="../../assets/img/user_bg.jpg" alt=""></div>
        <span>不负此生 | 这个盛夏，用才华致敬青春</span>
      </div>
      <div class="second">
        <router-link to="/" class="second-class">查看更多专题</router-link>
      </div>
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


// news的样式
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

// 分割线样式
.line {
  // float: left;
  clear: both;
  width: 95%;
  // height: 1px;
  border-top: 1px solid #888;
  margin: 0 auto;
  // padding: .3rem 0 0 0;
  text-align: center;
  font-size: .3rem;
  span {
    position: relative;
    top: -.2rem;
    background: #efefef;
    padding: 0 .3rem;
  }
  
}

.seminar-box {
  font-size: .3rem;
  clear: both;
  .first , .second {
    width: 90%;
    margin:  0 auto .3rem;
    padding: .2rem;
    border-radius: 5%;
    background-color: #fff;
    .first-left{
      display: inline-block;
      margin: 0;
      width: 40%;
      text-align: center;
      height: 1.3rem;
      overflow: hidden;
      img {
        width: 2rem;
      }
    }
    span {
      float: right;
      width: 60%;
    }
    
  }
  .second-class {
    color: $topic_color;
    text-align: center;
    display: block;
  }
    
}

</style>
