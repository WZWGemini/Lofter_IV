<template>
    <div class="index_body">
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
        <p>
            <router-link to="/lofter/home/follow">稍后再说</router-link>
        </p>
    </div>    
</template>
<script>
  export default {
    name: 'guide'
  }
</script>
<style>
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
    .index{
        height: 100%;
        background: linear-gradient(#398185, #67b7ba);
    }
    .index p{
        margin:0 auto;
        margin-top:10%;
        font-size:0.2rem;
        line-height:0.4rem;
        background-color: #398185;
        width: 20%;
        text-align:center;
        border-radius:10px;
    }
    .index p a{
        color:#fff;
    } 
</style>