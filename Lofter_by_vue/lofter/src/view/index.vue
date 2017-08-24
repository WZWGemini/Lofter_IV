<template>
  <!--第一次进入app页面  -->
  <div class="index">
    <div class="index_img animated fadeOut" v-show="showIndexImg">
         {{showIndexLater}}   
       <img src="../assets/img/logo_load_with_text.png"> 
    </div>
    <guide  v-show="showIndex">
    </guide> 
  </div>
</template>

<script>
import guide from './guide'
export default {
  name: 'index',
  // props: ['showIndexImg', 'showIndex'],
  data () {
    return {
      showIndexImg: true,
      showIndex: false
    }
  },
  methods: {

  },
  computed: {
    showIndexLater () {
      setTimeout(() => {
        this.showIndexImg = false
        this.showIndex = true
      }, 2000)
    }
  },
  components: {
    guide
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped>
  .index{
    height: 100%
  }
  .index_img{
    height: 100%;
    animation-delay:1s;
    background-color: #fff;
  }
  .index_img img{
    display:inline-block;
    width: 50%;
    margin:0 25%;
    margin-top:25%;
  }
</style>
