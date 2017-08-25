<template>
  <div>
    <div class="div-null"></div>
    <!-- 内容盒子 -->
    <div class="content">
      <div class="article-box">
        <div class="article-img-box">
          <img :src="item.article_img" class="article-img">
        </div>
        <div class="article-author"  @click="setgoodsInfo(item)">
          <span class="tip">作者：</span>
          <span class="user-name">{{item.user_name}}</span>
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
      ...mapState(['goodsInfo'])
    },
    methods: {
      ...mapMutations(['goodsInfoSave']),
      // 设置所需要显示的图片及作者姓名 id
      setgoodsInfo: function (item) {
        this.goodsInfoSave(item)
      }
    },
    components: {

    }
  }
</script>
<style scoped lang="scss">
@import "../../assets/common.scss";
.div-null {
  height: .8rem;
}
/*内容列表  */
.article-box {
  margin-bottom: .3rem;
  .article-img-box {
    width: 100%;
    height: 3rem;
    overflow: hidden;
    .article-img {
      width: 100%;
      position: relative;
      top: -.5rem;
    }
  }
  .article-author {
    width: 90%;
    color: #777;
    font-size: .35rem;
    margin: 0 auto;
    padding: .2rem 0;
    border-bottom: 1px solid #efefef;
  }
}
</style>