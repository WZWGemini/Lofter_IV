<template>
  <div class="index">

    <div class="swipe">
      <mt-swipe :auto="0">
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
</template>

<script>
export default {
  name: 'index',
  data () {
    return {

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
    font-size:.6rem;
    width: 90%;
    margin:0 5%;
    text-align:center;
  }
  .login{
    font-size:.3rem;
    color:#67b7ba;
    text-decoration:none;
    padding:1% 10%;
    border:2px solid #fff;
    border-radius:20px;
    margin-right:5%;
    background-color: #fff; 
  }
  .register{
    font-size:.3rem;
    text-decoration:none;
    color:#fff;
    padding:1% 10%;
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
  /* .swipe_1{
       background: url('../assets/img/login_page_one.png');
       background-size: 100%;
       background-repeat: no-repeat;   
       background-position: center;
  }
  .swipe_2{
       background: url('../assets/img/login_page_two.png');
       background-size: contain;
       background-repeat: no-repeat;   
       background-position: center;
  }
  .swipe_3{
       background: url('../assets/img/login_page_three.png');
       background-size: contain;
       background-repeat: no-repeat;   
       background-position: center;
  }
  .swipe_4{
       background: url('../assets/img/login_page_fore.png');
       background-size: contain;
       background-repeat: no-repeat;   
       background-position: center;
  }
  .swipe_5{
       background: url('../assets/img/login_page_five.png');
       background-size: 55% 20%;
       background-repeat: no-repeat;   
       background-position: top center;
  } */
</style>
