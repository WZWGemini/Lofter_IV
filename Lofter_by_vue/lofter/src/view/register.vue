<template>
  <!--注册界面  -->
  <div class="register">
    <mt-header fixed title="注册LOFTER" class="top-nav">
      <router-link to="/" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    <div class="content">
      <div class="landing-logo">
          <img class="replace-2x" src="../assets/img/logo.png" alt="img">
      </div>
      <div class="welcome-text">
        <h3>Welcome to Lofter</h3>
      </div>
      <div class="register-form">
        <ul class="register-ul">
          <li class="register-li">
            <mt-field label="用户名" v-model="user_name" class="username-class"></mt-field>
          </li>
          <li class="register-li">
            <mt-field label="密码" :type="switch_value ? 'password' : ''" v-model="user_pwd"></mt-field>
             <mt-switch v-model="switch_value" class="switch"></mt-switch> 
          </li>
          <li class="register-li">
            <mt-field label="确认密码" :type="switch_revalue ? 'password' : ''" v-model="user_repwd"></mt-field>
            <mt-switch v-model="switch_revalue" class="switch"></mt-switch>
          </li>
        </ul>
        <mt-button type="default" size="large" class="btn-register" :disabled="user_name=='' || user_pwd == '' || user_repwd == ''" v-on:click="doReg()">注册</mt-button>
      </div>
        <p class="bottom-text">2017. Welcome to Lofter</p>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'
import {Toast} from 'mint-ui'
export default {
  name: 'register',
  data () {
    return {
      user_name: '',
      user_pwd: '',
      user_repwd: '',
      switch_value: true,
      switch_revalue: true
    }
  },
  methods: {
    doReg: function () {
      Axios.post('/api/user', {
        user_name: this.user_name,
        user_pwd: this.user_pwd,
        user_repwd: this.user_repwd
      }).then(function (rtnData) {
        Toast(rtnData.data.msg)
      })
    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style lang="scss">
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

  .welcome-text h3{
    font-family:'Raleway', sans-serif;
    font-size: .3rem;
    color:#535353;
    font-weight:300;
    text-align:center;
    text-transform:uppercase;
    margin: .3rem 0;
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

  .register-form{
    width:75%;
    margin-left:auto;
    margin-right:auto;	
  }
  .register-ul {
    padding: 0;
    margin: .3rem 0 .5rem;
    float: left;
  }
  .register-li {
    border-bottom: .03rem solid #efefef;
    font-size:.25rem;
    float: left;
    width: 100%;
    padding-bottom: .01rem;
    .username-class {width: 100% !important;}
    .mint-cell {
      width: 79%;
      float: left;
      .mint-cell-title {
        width: 1.3rem;
        color: $topic_color;

      }
    }
    
    input {
      font-size: .4rem;
      color: #9d9d9d;
      font-family:'STKaiti', sans-serif;
    }
  }
  .register-li input {
    border: none;
    height: .55rem;
    outline: none;
    font-size: .4rem;
    width: 60%;
    color: #9d9d9d;
  }

  .switch {
    // right: .2rem;
    opacity: .5;
    position: relative;
    top: .2rem;
    float: left;
    span {
      background-color: $topic_color !important;
      // border-color: $topic_color;
    }
  }
  .btn-register {
    height: .6rem;
    color: #fff;
    background-color: $topic_color;
    font-family:'STKaiti', sans-serif;
    border-color: #4cae4c;
  }
  .btn-register.focus,
  .btn-register:focus {
    color: #fff;
    background-color: $topic_hcolor;
    border-color: $topic_hcolor
  }
  .btn-register:hover {
    color: #fff;
    background-color: $topic_hcolor;
    border-color: $topic_hcolor
  }

  .bottom-text{
    color:#252525;
    display:block;
    text-transform:uppercase;
    float:none;
    text-align:center;
    padding-top: .5rem;
    font-size:.2rem;
  }
  .register{
    padding: 0;
  }
</style>
