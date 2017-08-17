<template>
    <div>
        <!--每个头像上的灰条  -->
      <div class="line"></div>
        <!--内容  -->
      <div class="content-list-box">
        <!--内容顶部  -->
        <div class="top">
          <router-link to="/user">
            <ul @click="">
              <!--头像 用户名 时间  -->
              <li class="head-img">
                  <img src="../assets/img/user_head.jpg">    
              </li>
              <li class="user-name">{{item.user_name}}</li>
              <li class="time">{{item.article_time}}</li>
            </ul>
          </router-link>
        </div>
        <!--内容中部  -->
        <div class="mid">
          <!--短文 图片  -->
          <img :src="item.img">
          {{item.article_img}}
          <div class="content">
            <p>{{item.article_title}}</p>
            {{item.article_content}}
          </div>
          <!--标签  -->
          <div class="tag" v-if="item.articleTag.length!=0">
            <span class="icon-price-tag"></span>
            <span v-for="tag in item.articleTag">{{tag.tag_content}}</span>
          </div>
        </div>
        <!--底部  -->
        <div class="foot">
          <!--5个功能图标  -->
          <div class="btn-box">
            <span class="icon-heart heart"></span>
            <router-link to="/comment"><span @click="setCurInfo(item)" class="icon-bubble2 bubble"></span></router-link>
            <span class="icon-redo2 redo"></span>
            <span class="icon-like like"></span>
            <span class="icon-dots-three-horizontal dot"></span>
          </div>
          <!--评论  -->
          <div class="comment" v-if="item.articleComment.length!=0">
            <dl>
              <dt>
                126 热度  {{item.articleComment.length}}条评论
              </dt>
              <!--循环最新三条评论  -->
              <dd v-for="comment in limit">
                <span class="comment-user">{{comment.user_name}}</span>
                <span class="comment-colon">:</span>
                &nbsp;&nbsp;&nbsp;{{comment.comment_content}}
              </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>   
</template>
<script>
  import {mapState, mapMutations} from 'vuex'
  export default{
    props: ['item'],
    data () {
      return {

      }
    },
    computed: {
      ...mapState(['curComment']),
      limit: function () {
        if (this.item.articleComment.length > 3) {
          return this.item.articleComment.slice(0, 3)
        } else {
          return this.item.articleComment
        }
      }
    },
    methods: {
      ...mapMutations(['setCurComment']),
      // 设置目前点击微博所需要显示的评论及id
      setCurInfo: function (item) {
        this.setCurComment(item)
      }
    },
    components: {

    }
  }
</script>
<style scoped lang="scss">
@import "../assets/common.scss";
.line{
      height:.6rem;
      background-color: #F0F0F0;
    }

/*内容列表  */
.content-list-box{
  width: 100%;
  .top{
    overflow: hidden;
    line-height: .9rem;
    font-size: 0.2rem;
    padding:0 3%; 
    width:94%;
    height: 20%;
    ul{
      overflow: hidden;
      li{
        list-style:none;
        float:left;
        img{
          width: 100%;
        }
      }
      .head-img{
        width: .7rem;
        height: 0;
        padding-bottom: .7rem;
        margin-top: .15rem;
        border-radius: 50%;
        overflow: hidden;
        img {
          width: .7rem;
        }
      }
      .user-name{
        width: 30%;
        padding-left:5%; 
        font-size: .3rem;
        line-height: 1rem;
      }
      .time{
        color: #ccc;
        width: 30%;
        font-size: .2rem;
        line-height: 1rem;
        float: right;
      }
    }
  }
  .mid{
    width: 100%;
    font-size: .25rem;
    img{
      display:inline-block;
      width: 100%;
      height: auto;
    }
    .content{
      margin: 0 3%;
      border-left: 2px solid #ccc;
      p{
        text-align:center;
      }
    }
    .tag{  
      margin: 0 5%;
      padding: 3% 0;
      border-bottom: 1px dashed #888;
      span{
        padding:0 .1rem;
        font-size: .3rem;
        color:#888;
      }
    }
  }
  .foot{
    margin-top:3%; 
    .btn-box{
      margin-bottom: 2%;
      font-size: .3rem;
      color:#9e9e9e;
      span{
        margin-left: 10%;
      }
      .dot{
        margin-left:25% 
      }
    }
    .comment{
      dt{
        margin-left:7%;
        color:#777;
        font-size:.22rem;
      }
      dd{
        margin: .1rem 0;
        margin-left:7%;
        font-size: .25rem;
        .comment-user {
          color: $topic_color;
          font-weight: 600;
        }
        .comment-content, .comment-colon {
          color: #777;
          font-size: .23rem;
        }
      }
    }
  }
}
</style>