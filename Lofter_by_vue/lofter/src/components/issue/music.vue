<template>
  <div class="music-music">
    <div class="music-nav">
      <mt-search @keyup.native="musicSearch" v-model="value"></mt-search>
    </div>
    <div class="music-center">
      <div class="every-love border-top"><span>大家都爱听的音乐</span></div>	
      <!-- <router-link to="/lofter/issue/text/music"> -->
      <div v-for="(item,index) in result">
        <div class="music-love border-top" @click="musicTransmit(index)">
          <div class="music-album">
            <i></i>
            <audio :src="'http://music.163.com/song/media/outer/url?id='+item.id" class="music-play" type="" controls="controls"></audio>
            <img :src="item.album.picUrl" class="img">					
          </div>
          <h4 class="album-song">{{item.name}}</h4>
          <span class="album-name">{{item.album.artist.name}}</span>
          <span class="album-name song-name">{{item.album.name}}</span>
        </div>
      </div>
      <!-- </router-link> -->
      <div class="every-love border-top music-bottom"><span>暂时只有这么多了</span></div>
    </div>
  </div>
</template>
<script>
import {mapMutations} from 'vuex'
export default {
  data () {
    return {
      value: '',
      result: '',
      delay_time: ''
    }
  },
  methods: {
    ...mapMutations(['saveMusicData']),
    musicSearch: function (e) {
      if (this.value === '') {
        return
      } else {
        let that = this
        that.delay_time = e.timeStamp
        setTimeout(function () {
          // this.$http.jsonp('http://s.music.163.com/search/get/?version=1&src=lofter&type=1&filterDj=false&s=侧田&limit=8&offset=0').then(function (rtnData) {
          // console.log(rtnData)
          // })
          if (that.delay_time - e.timeStamp === 0) {
            that.$http.jsonp('http://s.music.163.com/search/get/?type=1&s=' + that.value + '&limit=10').then(function (rtnData) {
              that.result = rtnData.data.result.songs
              console.log(that.result)
            })
          }
        }, 1000)
      }
    },
    musicTransmit: function (index) {
      console.log(index)
      this.saveMusicData(this.result[index])
      this.$router.push({ path: '/lofter/issue/text/music' })
    }
  }
}
</script>
<style lang="scss">
  @import '../../assets/common.scss';

    .music-music,.music-music a{
      font-size: 0.25rem;
      color:#888;
    }
    .music-nav{
    overflow: hidden;
  }
  .mint-search{
    height: 9vh;
  }
  .mint-searchbar{
    background-color: #fff;
  }
  .mint-searchbar-inner,.mint-searchbar-inner input {
    background-color: #d9d9d9;
  }
  .mint-searchbar-inner .mintui-search{
    color: #999;
  }
  .mint-searchbar-inner{
    border-radius: 0.3rem;
  }
  .mint-searchbar-cancel{
    color: #999;
  }
  .mint-search-list{
    height:0rem;
      padding-top: 0rem; 
  }
  .music-center .border-top{
    border-top: 0.02rem solid #eee;
  }
  .music-center .every-love{		
    padding: 0.18rem 0;
    text-align: center;
  }
  .music-center .music-love{
    height: 9vh;
      padding:0.15rem 0.25rem;
      overflow: hidden;
  }
  .music-center .music-album{
    width: 1rem;
    height: 1rem;
    position:relative;
    float: left;
    overflow: hidden;
    display: inline-block;
    vertical-align: middle;
    margin-right: 0.25rem;
  }
  .music-center .music-play{
    background: #000;
    position: absolute;
    height: 1rem;
    top: 0rem;
    left: 0rem;
    opacity:0.5;
  }
  .img{
    width: 100%;
  }
  .music-center .album-song{
    font-size: 0.32rem;
    color: #333;
    margin: 0;
    font-weight: 500;
    width: 68%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .music-center .album-name{
    display: inline-block;
    float:left;
    width: 68%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .music-center .music-bottom{
    padding: 0.28rem 0;
  }
</style>