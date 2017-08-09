<template>
  <!--登陆 注册引导页  -->
  <div class="index">
    <div class="index_img animated fadeOut" v-show="showIndexImg">
         {{showIndexLater}}   
       <img src="../assets/img/logo_load_with_text.png"> 
    </div>
    <div class="index_body"  v-show="showIndex">
      <div class="swipe">
        <mt-swipe :auto="4000">
          <mt-swipe-item class="swipe_1"><img src="../assets/img/login_page_one.png" alt=""></mt-swipe-item>
          <mt-swipe-item class="swipe_2"><img src="../assets/img/login_page_two.png" alt=""></mt-swipe-item>
          <mt-swipe-item class="swipe_3"><img src="../assets/img/login_page_three.png" alt=""></mt-swipe-item>
          <mt-swipe-item class="swipe_4"><img src="../assets/img/login_page_fore.png" alt=""></mt-swipe-item>
          <mt-swipe-item class="swipe_5"><img src="../assets/img/login_page_five.png" alt=""></mt-swipe-item>
        </mt-swipe>
      </div>
      <div class="button_div">
        <router-link to='/login' class="login">
          登录
        </router-link>
        <router-link to='/register' class="register">
          注册
        </router-link>
      </div>
      <p>稍后再说</p>
    </div>  
  </div>
</template>

<script>
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
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped>
  .index{
    height: 100%;
    background: linear-gradient(#398185, #67b7ba);
  }
  .index_body{
    height: 100%;
  }
  .swipe{
    padding-top:15%;
    height: 65%;
  }
  .swipe img{
    display:inline-block;
    width: 100%;
  }
  .swipe_5 img{
    width: 70%;
    margin:10% 15%;
  }
  .button_div{
    font-size:.8rem;
    width: 90%;
    margin:0 5%;
    text-align:center;
  }
  .login{
    font-size:.3rem;
    color:#67b7ba;
    text-decoration:none;
    padding:2% 10%;
    border:2px solid #fff;
    border-radius:20px;
    margin-right:5%;
    background-color: #fff; 
  }
  .register{
    font-size:.3rem;
    text-decoration:none;
    color:#fff;
    padding:2% 10%;
    margin-left:5%;
    border:2px solid #fff;
    border-radius:20px;
  }
  p{
    margin:0 auto;
    margin-top:10%;
    font-size:0.2rem;
    line-height:0.4rem;
    background-color: #398185;
    width: 20%;
    text-align:center;
    color:#fff;
    border-radius:10px;
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
