<template>
    <div class="text">
        <div class="text-nav">
            <router-link to="/lofter/follow" class="nav-cancel">取消</router-link>
            <div class="user-info">
                <div class="user-head"><img src="../../assets/img/user_head.jpg"></div>
                <span class="user-name">{{uinfo}}</span>
            </div>
        </div>
        <div class="article-box">
            <mt-field placeholder="文章标题（可不填）" v-model="articleTitle" class="article-title"></mt-field>
            <mt-field placeholder="说点什么" type="textarea" v-model="articleContent" rows="10" class="article-content"></mt-field>
            <div class="add-tag">    
                <mt-field placeholder="添加标签" type="textarea" v-model="addTag" rows="1" class="article-tag"><span class="icon-price-tag article-icon"></span></mt-field>
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
import {mapState} from 'vuex'
export default{
  name: 'text',
  data () {
    return {
      articleTitle: '',
      articleContent: ''
    }
  },
  computed: {
    ...mapState(['uinfo'])
  },
  methods: {
    issueText: function () {
      // console.log(this.uinfo)
      Axios.post('/api/article', {
        article_title: this.articleTitle,
        article_content: this.articleContent
        // user_id: this.uinfo
      }).then(function (rtnData) {
        Toast(rtnData.data.msg)
      })
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
        width: 100%;
        .article-icon {
            // float: left;
            // text-align: center;
            // padding-top: .25rem;
            // width: 10%;
            opacity: .5;
            // font-size: 20px;
            font-size: .35rem;
            display: block;
            position: relative;
            // z-index: 1;
            // top: 35px;
            left: -5.7rem;
            top: .03rem;
        } 
        .article-tag {
            width: 100%;
            float: left;
            border-bottom: 1px solid #efefef;
            .mint-field-core {
                margin-left: .52rem;
                resize:none;
            }
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