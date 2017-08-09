<template>
    <div class="follow">
        <header  v-show='showHeadImg'>
            <span class="icon-cross" @click='showSheet()'>
            </span>
            <img src="../../assets/img/copyright_watermark_sample.png">
            <mt-actionsheet
              :actions="actions"
              v-model="sheetVisible">
            </mt-actionsheet>
        </header>
        <div class="fol-list">
            <ul>
              <li v-for="item in contentList">
                <div class="content-list-box">
                  <div class="top">
                    <ul>
                      <li class="head-img">
                           <img src="../../assets/img/user_head.jpg">    
                      </li>
                      <li class="user-name">啊哈哈</li>
                      <li class="time">一个小时前</li>
                    </ul>
                  </div>
                  <div class="mid">
                    <img :src="item.img">
                  </div>
                  <div class="foot">
                    
                  </div>
                </div>
                {{item.msg}}
              </li>
            </ul>
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
        {msg: '1', img: '/static/user_head.jpg'},
        {msg: '2', img: '/src/assets/img/user_head.jpg'},
        {msg: '3', img: '../../assets/img/user_head.jpg'}
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
    /*内容列表  */
    .content-list-box{
      width: 100%;
      .top{
        font-size: 0.2rem;
        width: 100%;
        height: 20%;
        ul{
          overflow: hidden;
          li{
            list-style:none;
            float:left;
            img{
              width: 70%;
              vertical-align: top;
            }
          }
          .head-img{
            width: 20%;
          }
          .user-name{
            width: 40%;
            font-size: .3rem;
            line-height: 1rem;
          }
          .time{
             padding-left: 20%; 
            width: 20%;
            font-size: .2rem;
            line-height: 1rem;
          }
        }
      }
      .mid{
        img{
          display:inline-block;
          width: 100px;
          height: 100px;
        }
      }
    } 
}
</style>