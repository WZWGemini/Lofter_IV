<template>
    <div class="follow">
      <!--顶部广告照片  -->
        <header  v-show='showHeadImg'>
            <span class="icon-cross" @click='showSheet()'>
            </span>
            <img src="../../assets/img/copyright_watermark_sample.png">
            <mt-actionsheet
              :actions="actions"
              v-model="sheetVisible">
            </mt-actionsheet>
        </header>
          <!--内容  -->
        <div class="fol-list">
            <ul>
              <li v-for="item in contentList">
              <!--每个头像上的灰条  -->
              <div class="line"></div>
              <!--内容  -->
                <div class="content-list-box">
                  <!--内容顶部  -->
                  <div class="top">
                    <ul>
                      <!--头像 用户名 时间  -->
                      <li class="head-img">
                           <img src="../../assets/img/user_head.jpg">    
                      </li>
                      <li class="user-name">啊哈哈</li>
                      <li class="time">一个小时前</li>
                    </ul>
                  </div>
                  <!--内容中部  -->
                  <div class="mid">
                    <!--短文 图片  -->
                    <img :src="item.img">
                    <div class="content">
                      内容
                    </div>
                    {{item.msg}}
                    <!--标签  -->
                    <div class="tag">
                      <span class="icon-price-tag"></span>
                      <span v-for="tag in item.tagList">{{tag}}</span>
                    </div>
                  </div>
                  <!--底部  -->
                  <div class="foot">
                    <!--5个功能图标  -->
                    <div class="btn-box">
                      <span class="icon-heart heart"></span>
                      <span class="icon-bubble2 bubble"></span>
                      <span class="icon-redo2 redo"></span>
                      <span class="icon-like like"></span>
                      <span class="icon-dots-three-horizontal dot"></span>
                    </div>
                    <!--评论  -->
                    <div class="comment">
                      <dl>
                        <dt>
                          126 热度  5条评论
                        </dt>
                        <!--循环最新三条评论  -->
                        <dd v-for="comment in item.commentList">
                          <span>{{comment.name}}:</span>&nbsp;&nbsp;&nbsp;{{comment.comment}}
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <!--解决底部导航栏挡住内容问题  -->
            <div style="height:1rem">
            </div>
        </div>
    </div>    
</template>
<script>
export default{
  name: 'homeFollow',
  data () {
    return {
      showHeadImg: true,
      sheetVisible: false,
      actions: [{
        name: '不再显示',
        method: () => {
          this.closeHeadImg()
        }
      }],
      contentList: [
        {
          msg: '1',
          img: '/static/user_head.jpg',
          tagList: ['鱼哈哈', '鱼哈哈'],
          commentList: [{
            name: '鱼哈哈1',
            comment: '鱼哈哈~'
          },
          {
            name: '鱼哈哈1',
            comment: '鱼哈哈~'
          },
          {
            name: '鱼哈哈1',
            comment: '鱼哈哈~'
          }]
        },
        {
          msg: '2',
          img: '/static/user_head.jpg',
          tagList: ['鱼哈哈', '鱼哈哈'],
          commentList: [{
            name: '鱼哈哈2',
            comment: '鱼哈哈~'
          },
          {
            name: '鱼哈哈2',
            comment: '鱼哈哈~'
          },
          {
            name: '鱼哈哈2',
            comment: '鱼哈哈~'
          }]
        },
        {
          msg: '3',
          img: '/static/user_head.jpg',
          tagList: ['鱼哈哈', '鱼哈哈'],
          commentList: [{
            name: '鱼哈哈3',
            comment: '鱼哈哈~'
          }]
        }
      ]
    }
  },
  methods: {
    showSheet () {
      this.sheetVisible = true
    },
    closeHeadImg () {
      this.showHeadImg = false
    }
  }
}
</script>
<style lang="scss">
.follow{
  margin-top: 2px;
    height: 100%;
    /*头部  */
    header{
        position:relative;
        width: 100%;
        height: 20%;
        overflow:hidden;
        img{  
          width: 100%;
        }
        span{
            display:inline-block;
            padding: 0.1rem;
            background-color: #636363;
            border-radius: 50%;
            font-size: 0.2rem;
            color:#ccc;
            position: absolute;
            top:5%;
            right:2%;
        }
    }
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
            width: .9rem;
            height: .9rem;
            border-radius: 50%;
            overflow: hidden;
          }
          .user-name{
            width: 30%;
            padding-left:10%; 
            font-size: .3rem;
            line-height: 1rem;
          }
          .time{
            color: #ccc;
             padding-left: 20%; 
            width: 20%;
            font-size: .15rem;
            line-height: 1rem;
          }
        }
      }
      .mid{
        width: 100%;

        img{
          display:inline-block;
          width: 100%;
          height: auto;
        }
        .content{
          margin: 0 3%;
          border-left: 1px solid red;
        }
        .tag{  
          margin: 0 5%;
          border-bottom: 1px dashed #e0e0e0;
          span{
            padding:0 .1rem;
            font-size: .3rem;
            color:#e0e0e0;
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
          .heart{

          }
          .dot{
            margin-left:25% 
          }
        }
        .comment{
          dt{
            margin-left:7%;
            color:#e0e0e0;
            font-size:.2rem;
          }
          dd{
            margin: .1rem 0;
            margin-left:7%;
            font-size: .25rem;
            span{
              color:#26c6da;
            }
          }
        }
      }
    } 
}
</style>