<template>
    <div class="text">
        <div class="text-nav">
            <router-link to="/lofter/home/follow" class="nav-cancel">取消</router-link>
            <div class="user-info">
                <div class="user-head"><img src="../../assets/img/user_head.jpg"></div>
                <span class="user-name">{{uinfo.user_name}}</span>
            </div>
        </div>
        <div class="article-box">
            <mt-field placeholder="文章标题（可不填）" v-model="articleTitle" class="article-title"></mt-field>
            <mt-field placeholder="说点什么" type="textarea" v-model="articleContent" rows="10" class="article-content"></mt-field>
            <div class="add-tag">
                <i class="icon-price-tag article-icon"></i>
                <span class="tag-show" v-for="item in tagName" >{{item}}</span>
                <input class="tag-input" @keydown="addTags($event)" type="text" maxlength="6" placeholder="添加标签">
                <!-- <mt-field placeholder="添加标签" rows="1" class="article-tag" @keydown.native="addTags($event)"></mt-field> -->
            </div>
            
        </div>
        <!-- <router-link to="">发布</router-link> -->
        <mt-button type="default" size="large" class="btn-issue" v-on:click="issueText()">发布</mt-button>
    </div>    
</template>
<script>
import Axios from 'axios'
import {Toast} from 'mint-ui'
// 单独引入 辅助函数
import {mapState, mapMutations} from 'vuex'
export default{
  name: 'text',
  data () {
    return {
      articleTitle: '',
      articleContent: '',
      tagName: []
    }
  },
  computed: {
    ...mapState(['uinfo', 'tag'])
  },
  methods: {
    ...mapMutations(['tagSave', 'tagRemove', 'tagClear']),
    issueText: function () {
      if (this.articleContent === '') {
        Toast('内容不能为空')
        return
      }
      console.log(this.uinfo.user_id)
      Axios.post('/api/article', {
        article_title: this.articleTitle,
        article_content: this.articleContent,
        user_id: this.uinfo.user_id,
        tag_arr: this.tag.join(',')
      }).then(function (rtnData) {
        Toast(rtnData.data.msg)
      })
    },
    addTags: function (e) {
      // 插入标签
      if (e.keyCode === 13) {
        if (e.target.value === '') return
        this.$http.post('/api/tag', {
          tag_content: e.target.value
        }).then((rtnData) => {
          if (rtnData.data.status === 1) {
            // 把标签id保存到store
            this.tagSave(parseInt(rtnData.data.data.tag_id))
            // 存储标签名
            if (this.tagName.indexOf(e.target.value) === -1) {
              this.tagName.push(e.target.value)
            }
            e.target.value = ''
          } else {
            this.toast(rtnData.data.msg)
          }
        })
      } else if (e.keyCode === 8) {
        if (e.target.value === '') {
          this.tagRemove()
          this.tagName.splice(-1, 1)
        }
      }
    }
  }
}
</script>
<style lang="scss">
@import "../../assets/common.scss";

.text-nav {
    height: 10%;
    width: 100%;
    font-size: .3rem;
    color: $topic_color;
    padding: .1rem 0;
    border-bottom: 1px solid #777;
    text-align:center;
    .nav-cancel {
        width: 20%;
        color: $topic_color;
        padding-top: .1rem;
        float: left;
    }
    .user-info {
        display: inline-block;
        width: 30%;
        vertical-align:middle;
        .user-head {
            float: left;
            width: .55rem;
            height: .55rem;
            overflow: hidden;
            img {
                float: left;
                width: 100%;
            }
        }
        .user-name {
            float: left;
            vertical-align:middle;
            font-size: .35rem;
            padding-top: .1rem;
        }
    }
}

.article-box {
    .article-title {
        border-bottom: 1px solid #efefef;
    }
    .article-content {
        border-bottom: 1px solid #efefef;
    }
    .add-tag {
        overflow-wrap: break-word;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        font-size: .35rem;
        .article-icon {
          font-size: .35rem;
          opacity: .5;
          padding: 0px 5px 0 10px;
        }
        .tag-input {
          font-size: .3rem;
          height: .5rem;
          border:none;
          padding-left: 10px;
          margin:2px;
          width: 30%;
        }
        .tag-show {
          font-size: .3rem;
          opacity: .6;
          padding: 0px 5px;
          border: 1px solid #336162;
          margin: 0 2px;
          border-radius: 5px;
          background-color: #336162;
          color: #fff;
        }
    }
}

.btn-issue {
    height: .8rem;
    color: #fff;
    background-color: $topic_color;
    font-family:'STKaiti', sans-serif;
    border-color: #4cae4c;
    border-radius: 0;
    position: absolute;
    bottom: 0;
    font-size: .35rem;
  }
  .btn-issue.focus,
  .btn-issue:focus {
    color: #fff;
    background-color: $topic_hcolor;
    border-color: $topic_hcolor
  }
  .btn-issue:hover {
    color: #fff;
    background-color: $topic_hcolor;
    border-color: $topic_hcolor
  }
</style>