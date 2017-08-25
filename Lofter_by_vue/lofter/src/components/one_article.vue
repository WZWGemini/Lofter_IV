<template>
  <div>
    <div style="height:.7rem"></div>
    <h :title="disAllArtIndex.user_name"></h>
      <!--内容  -->
    <div class="content-list-box">
      <!--内容顶部  -->
      <div class="top">
          <ul>
            <!--头像 用户名 时间  -->
            <li class="head-img">
                <img :src="disAllArtIndex.user_head">    
            </li>
            <li class="user-name">{{disAllArtIndex.user_name}}</li>
            <li class="fol-box" v-if="folBoxVisible">
              <span class="unfollow" v-show="!followVisible" @click="follow()">关&nbsp&nbsp注</span>
              <span class="follow" v-show="followVisible" @click="follow()">已关注</span>
            </li>
          </ul>
      </div>
      <!--内容中部  -->
      <div class="mid">
        <!--短文 图片  -->
        <div class="mid-img-box" v-for="img in JSON.parse(disAllArtIndex.article_img)">
            <!-- <img :src="'http://localhost:808/'+img"> 数据库数据改变，可能需要匹配是否是用户自己发布-->
            <img :src="img">
        </div>
        <div class="content">
          <p>{{disAllArtIndex.article_title}}</p>
          {{disAllArtIndex.article_content}}
        </div>
        <!--标签  -->
        <div class="tag" v-if="disAllArtIndex.articleTag.length!=0">
          <span class="icon-price-tag"></span>
          <span v-for="tag in disAllArtIndex.articleTag">
            <router-link :to="'/tag/'+ tag.tag_id">{{tag.tag_content}}</router-link>
          </span>
        </div>
      </div>
      <!--底部  -->
      <div class="foot">
        <!--5个功能图标  -->
        <div class="btn-box">
          <span class="love" @click="love()">
            {{isloveActive}}
            <vue-star animate="animated bounceIn" :color=" colorActive ? '#d50000':'#bdbdbd'" :class="{loveActive:colorActive }">
              <i slot="icon" class="fa fa-heart"></i>
            </vue-star>
          </span>
          <router-link to="/comment"><span @click="setCurInfo(disAllArtIndex)" class="icon-bubble2 bubble"></span></router-link>
          <span class="icon-redo2 redo"@click="showShare()"></span>
          <mt-actionsheet
          :actions="shareActions"
          v-model="shareSheetVisible">
        </mt-actionsheet>
          <span class="good">
            <vue-star animate="animated bounceIn" color="#F05654">
              <i slot="icon" class="fa fa-thumbs-up"></i>
            </vue-star>
          </span>
        </div>
        <!--评论  -->
        <div class="comment" v-if="disAllArtIndex.articleComment.length!=0">
          <dl>
            <dt>
              126 热度  {{disAllArtIndex.articleComment.length}}条评论
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
import axios from 'axios'
import h from './shop/home_top_nav'
export default{
  data () {
    return {
      err: '',
      post: '',
      shareSheetVisible: false,
      shareActions: [
        {name: '分享到微博',
          method: function () {
            this.$toast('成功分享！')
          }
        }
      ],
      colorActive: false, // 点赞图标颜色
      followVisible: false, // true 为已关注
      folBoxVisible: true // follow 盒子 若用户自己点开自己的文章 则不显示
    }
  },
  computed: {
    ...mapState(['curComment', 'disAllArtIndex', 'uinfo', 'hasLogin']),
    limit: function () {
      if (this.disAllArtIndex.articleComment.length > 3) {
        return this.disAllArtIndex.articleComment.slice(0, 3)
      } else {
        return this.disAllArtIndex.articleComment
      }
    },
    // 请求判断当前用户是否已经对该文章点赞
    isloveActive: function () {
      if (this.hasLogin) {
        axios.get('api/hot', {
          params: {
            user_id: this.uinfo.user_id,
            article_id: this.disAllArtIndex.article_id
          }
        }).then((response) => {
          // console.log(response.data.rtn)
          if (response.data.rtn) {
            this.colorActive = true
          }
        }).catch((error) => {
          console.log(error)
        })
      }
    }
  },
  methods: {
    ...mapMutations(['setCurComment']),
    // 设置目前点击微博所需要显示的评论及id
    setCurInfo: function (item) {
      this.setCurComment(item)
    },
    follow () {
      if (this.hasLogin) {
        console.log(this.followVisible)
        if (!this.followVisible) {
          axios.post('/api/onearticle', {
            user_id: this.uinfo.user_id,
            concern_user_id: this.disAllArtIndex.user_id
          }).then((response) => {
            console.log(response)
            this.followVisible = !this.followVisible
          }).catch((error) => {
            console.log(error)
          })
        } else {
          axios.delete('/api/onearticle/7', {
            params: {
              user_id: this.uinfo.user_id,
              concern_user_id: this.disAllArtIndex.user_id
            }
          }).then((response) => {
            console.log(response)
            this.followVisible = !this.followVisible
          }).catch((error) => {
            console.log(error)
          })
        }
      } else {
        this.$toast('请先登陆！')
      }
    },
    love: function () {
      if (this.colorActive) {
        // 为真， 点击则为取消点赞，反之
        console.log('love')
        axios.delete('api/hot/7', {
          params: {
            user_id: this.uinfo.user_id,
            article_id: this.disAllArtIndex.article_id
          }
        }).then((response) => {
          console.log(response)
          if (response.data.rtn === 1) {
            this.colorActive = false
          }
        }).catch((error) => {
          console.log(error)
        })
      } else {
        console.log('unlove')
        axios.post('api/hot', {
          user_id: this.uinfo.user_id,
          article_id: this.disAllArtIndex.article_id
        }).then((response) => {
          console.log(response)
          if (response.data.rtn === 1) {
            this.colorActive = true
          }
        }).catch((error) => {
          console.log(error)
        })
      }
    },
    showShare: function () {
      console.log(1)
      this.shareSheetVisible = true
    }
  },
  components: {
    h
  },
  beforeRouteEnter (to, from, next) {
    next((vm) => {
      if (vm.hasLogin) {
        console.log(vm.uinfo.user_id)
        console.log(vm.disAllArtIndex.user_id)
        if (vm.uinfo.user_id !== vm.disAllArtIndex.user_id) {
          axios.get('api/onearticle', {
            params: {
              user_id: vm.uinfo.user_id,
              concern_user_id: vm.disAllArtIndex.user_id
            }
          }).then((response) => {
            console.log(response.data.rtn)
            if (response.data.rtn === true) {
              vm.followVisible = true
            }
          }).catch((error) => {
            console.log(error)
          })
        } else {
          vm.folBoxVisible = false
        }
      }
    })
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
    .fol-box{
      width: 20%;
      float: right;
      font-size: .35rem;
      .follow{
        border-radius: 10px;
        color:#bdbdbd;
        border: 1px solid #bdbdbd; 
        padding:.05rem;
      }
      .unfollow{
        border-radius: 10px;
        background-color: green;
        color:#fff;
        padding:.05rem;
      }
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
      margin-left: 15%;
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
.love{
  position: relative;
  .VueStar{
    position: absolute;
    top:-.75rem;
    left:-.9rem;
  }
}
.good{
  position: relative;
  .VueStar{
    position: absolute;
    top:-.75rem;
    left:-.9rem;
  }
}
.loveActive{
  color: #d50000;
}
</style>