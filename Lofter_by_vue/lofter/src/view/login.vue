<template>
  <div class="login">
    <div class="content">
      <div class="landing-logo">
          <img class="replace-2x" src="../assets/img/logo.png" alt="img" width="100">
      </div>
      <div class="welcome-text">
        <h3>Welcome to Lofter</h3>
          <p></p>    
      </div>
      <div class="login-form">
        <ul class="login-ul">
          <li class="login-li">
            <label for="user_name">用户名</label>
            <input type="text" id='user_name'/>
          </li>
          <li class="login-li">
            <label for="password">密码</label>
            <input type="password" id='user_password'/>
          </li>
        </ul>
        <input type="submit" class="form-control btn btn-success btn-login" value="登录"/>
      </div>
        <p class="bottom-txt bottom-text">2017. Welcome to Lofter</p>
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
<style scoped>
  /* CSS Document */

  body{
    background-color:#FFFFFF;
  }

  a, ul, li {text-decoration:none;list-style:none;}

  .landing-logo{
    width:100px;
    margin-left:auto;
    margin-right:auto;
    margin-top:20px;
  }

  .bottom-txt{
    margin-bottom:50px;
    text-align:center;
  }

  .welcome-text h3{
    font-family:'Raleway', sans-serif;
    font-size:20px;
    color:#535353;
    font-weight:300;
    text-align:center;
    text-transform:uppercase;
    margin-top:20px;
  }

  .welcome-text p{
    text-align:center;
    font-size:14px;
    font-family:'Dosis', sans-serif;
    font-weight:400;
    text-transform:uppercase;
    margin-top:5px;
    margin-bottom:50px;
    color:#ce1a13;
  }

  .login-form{
    width:270px;
    margin-left:auto;
    margin-right:auto;	
  }
  .login-ul {
    padding: 0;
  }
  .login-li {
    height: 42px;
    border-bottom: 2px solid #efefef;
    margin-bottom: 10px;
    font-size:.25rem;
  }

  .login-li label {
    text-align:center;
    display:inline-block;
    width: 17%;
    margin-right: 10px;
  }

  .login-li input {
    border: none;
    height: 38px;
      outline: none;
      font-size: 20px;
      width: 180px;
      color: #9d9d9d;
  }

  .btn-login {
    background-color: #336162;
  }

  .bottom-text{
    color:#252525;
    display:block;
    text-transform:uppercase;
    float:none;
    text-align:center;
    margin-top:20px;
    font-size:12px;
  }
</style>
