<template>
  <!--登陆界面  -->
  <div class="login">
    <mt-header fixed title="登录LOFTER" class="top-nav">
      <router-link to="/" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    <div class="content">
      <div class="landing-logo">
          <img class="replace-2x" src="../assets/img/logo.png" alt="img" width="100">
      </div>
      <div class="welcome-text">
        <h3>Welcome to Lofter</h3>
      </div>
      <div class="login-form">
        <ul class="login-ul">
          <li class="login-li">
            <label for="user_name">用户名</label>
            <input type="text" id='user_name'/>
          </li>
          <li class="login-li">
            <label for="password">密&nbsp;&nbsp;码</label>
            <input type="password" id='user_password'/>
          </li>
        </ul>
        <input type="submit" class="form-control btn btn-success btn-login" value="登录"/>
      </div>
        <p class="bottom-text">2017. Welcome to Lofter</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'login',
  data () {
    return {

    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../assets/common.scss';
  /* CSS Document */

  body{
    background-color:#FFF;
  }

  a, ul, li {text-decoration:none;list-style:none;}

  .top-nav{
    background-color: $topic_color;
    font-size: .3rem;
    height: 10%;
  }

  .landing-logo{
    width:30%;
    margin-left:auto;
    margin-right:auto;
    padding-top:1.8rem;
  }

  .bottom-txt{
    margin-bottom:50px;
    text-align:center;
  }

  .welcome-text h3{
    font-family:'Raleway', sans-serif;
    font-size: .3rem;
    color:#535353;
    font-weight:300;
    text-align:center;
    text-transform:uppercase;
    margin-top:20px;
    margin-bottom:50px;
  }

  .welcome-text p{
    text-align:center;
    font-size:14px;
    font-family:'Dosis', sans-serif;
    font-weight:400;
    text-transform:uppercase;
    margin-top:5px;
    color:#ce1a13;
  }

  .login-form{
    width:75%;
    margin-left:auto;
    margin-right:auto;	
  }
  .login-ul {
    padding: 0;
  }
  .login-li {
    height: .6rem;
    border-bottom: 2px solid #efefef;
    margin-bottom: .2rem;
    font-size:.25rem;
  }

  .login-li label {
    text-align:center;
    display:inline-block;
    width: 17%;
    margin-right: 0.15rem;
  }

  .login-li input {
    border: none;
    height: .55rem;
    outline: none;
    font-size: .4rem;
    width: 60%;
    color: #9d9d9d;
  }

  .btn-login {
    height: .6rem;
    color: #fff;
    background-color: #336162;
    border-color: #4cae4c
  }
  .btn-login.focus,
  .btn-login:focus {
    color: #fff;
    background-color: #488283;
    border-color: #488283
  }
  .btn-login:hover {
    color: #fff;
    background-color: #488283;
    border-color: #488283
  }

  .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: .28rem;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px
  }

  .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 100%;
    margin-bottom: 0
  }

  .bottom-text{
    color:#252525;
    display:block;
    text-transform:uppercase;
    float:none;
    text-align:center;
    padding-top:1.5rem;
    font-size:.2rem;
  }
</style>
